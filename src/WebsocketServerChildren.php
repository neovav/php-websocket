<?php
namespace Websocket;

/**
 * Class for work with children thread socket server
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
class WebsocketServerChildren extends SocketIO
{
        /** @var int SHUTDOWN_READ      Shut down read for socket */
    const SHUTDOWN_READ     = 0;

        /** @var int SHUTDOWN_WRITE      Shut down write for socket */
    const SHUTDOWN_WRITE    = 1;

        /** @var int SHUTDOWN_ALL      Shut down read and write for socket */
    const SHUTDOWN_ALL      = 2;

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
        $this->isConnected = true;
    }

    /**
     * Destructor of the Socket class
     */
    public function __destruct()
    {
        if ($this->isConnected) {
            $this->close();
        }
    }

    /**
     * Shuts down a socket for receiving, sending, or both
     *
     * @param int $how
     *
     * @return bool
     */
    public function shutdown(int $how = self::SHUTDOWN_ALL): bool
    {
        return socket_shutdown($this->resource, $how);
    }

    /**
     * Close socket connection
     *
     * @return WebsocketServerChildren
     */
    public function close(): WebsocketServerChildren
    {
        if ($this->isConnected) {
            $this->shutdown(self::SHUTDOWN_ALL);
            socket_close($this->resource);
            $this->isConnected = false;
        }

        return $this;
    }
}