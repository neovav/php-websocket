<?php
namespace Websocket;

use Websocket\Exceptions\ExceptionSocket;
use Websocket\Exceptions\ExceptionSocketErrors;
use Websocket\Exceptions\ExceptionSocketIO;

/**
 * Class for input output over socket
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
class SocketIO extends Socket
{
        /** @var resource $resource     Resource handler to socket */
    private $resource;

        /** @var bool $isConnected      Connection is establish */
    protected bool $isConnected = false;

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
     * Read data from socket
     *
     * @param int $length
     * @param int $type
     *
     * @return string
     *
     * @throws ExceptionSocket|ExceptionSocketErrors|ExceptionSocketIO
     */
    public function read(int $length, int $type = self::READ_TYPE_BINARY): string
    {
        if (!$this->isConnected) {
            throw new ExceptionSocketIO('Connection is close', ExceptionSocketIO::__CONNECTION_IS_CLOSE);
        }

        if ($type !== self::READ_TYPE_BINARY && $type !== self::READ_TYPE_NORMAL) {
            throw new ExceptionSocket("Unknown read type - $type", ExceptionSocket::__UNKNOWN_READ_TYPE);
        }
        $result = socket_read($this->resource, $length, $type);

        if (is_bool($result) && !$result) {
            ExceptionSocketErrors::generate($this->resource);
        }

        return $result;
    }

    /**
     * Write data to socket
     *
     * @param string $data
     * @param int $length
     *
     * @return int
     *
     * @throws ExceptionSocketErrors
     */
    public function write(string $data, int $length = 0): int
    {
        if (empty($length)) {
            $length = mb_strlen($data);
        }

        $result = socket_write($this->resource, $data, $length);

        if (is_bool($result) && !$result) {
            ExceptionSocketErrors::generate($this->resource);
        }

        return $result;
    }
}