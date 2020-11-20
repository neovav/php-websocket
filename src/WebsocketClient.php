<?php
namespace Websocket;

use Websocket\Exceptions\ExceptionSocket;
use Websocket\Exceptions\ExceptionSocketErrors;
use Websocket\Exceptions\ExceptionSocketIO;
use Websocket\Exceptions\ExceptionWebsocketClient;

/**
 * Class for work with socket client
 *
 * Copyright 2020 neovav. All rights reserved.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License
 *
 * @author Verveda Aleksandr
 * @email neovav@outlook.com
 */
class WebsocketClient extends SocketIO
{
        /** @var resource $resource     Resource handler to socket */
    private $resource;

    /**
     * Constructor of the Socket class
     *
     * @param SocketResource $resource
     * @param string $address
     * @param int $port
     */
    public function __construct(SocketResource $resource, string $address = '127.0.0.1', int $port = 80)
    {
        parent::__construct($resource, $address, $port);

        $this->resource = $resource->resource();
    }

    /**
     * Destructor of the Socket class
     */
    public function __destruct()
    {
        if ($this->isConnect()) {
            $this->close();
        }
    }

    /**
     * Establish connect with remote service
     *
     * @return WebsocketClient
     *
     * @throws ExceptionWebsocketClient|ExceptionSocketErrors
     */
    public function connect(): WebsocketClient
    {
        $address = $this->address();
        $port = $this->port();
        @socket_clear_error($this->resource);
        $result = @socket_connect($this->resource, $address, $this->port());
        if (!empty(@socket_last_error($this->resource))) {
            ExceptionSocketErrors::generate($this->resource);
        };
        if ($result === false && $this->getBlockMode()) {
            throw new ExceptionWebsocketClient(
                "Error connect to adress: $address (port: $port)",
                ExceptionWebsocketClient::__ERROR_CONNECT_TO_RESOURCE
            );
        }
        $this->isConnected = true;
        return $this;
    }

    /**
     * Disconnect with remote service
     *
     * @return WebsocketClient
     */
    public function close(): WebsocketClient
    {
        @socket_close($this->resource);
        $this->isConnected = false;
        return $this;
    }

    /**
     * Check connection status
     *
     * @return bool
     */
    public function isConnect(): bool
    {
        return $this->isConnected;
    }

    /**
     * Read data from socket
     *
     * @param int $length
     * @param int $type
     *
     * @return string
     *
     * @throws ExceptionSocket|ExceptionSocketErrors|ExceptionSocketIO|ExceptionWebsocketClient
     */
    public function read(int $length, int $type = self::READ_TYPE_BINARY): string
    {
        if (!$this->isConnect()) {
            $this->connect();
        }

        return parent::read($length, $type);
    }

    /**
     * Write data to socket
     *
     * @param string $data
     * @param int $length
     *
     * @return int
     *
     * @throws ExceptionSocket|ExceptionSocketErrors|ExceptionSocketIO|ExceptionWebsocketClient
     */
    public function write(string $data, int $length = 0): int
    {
        if (!$this->isConnect()) {
            $this->connect();
        }

        return parent::write($data, $length);
    }
}