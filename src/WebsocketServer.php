<?php
namespace Websocket;

use Websocket\Exceptions\ExceptionSocketErrors;
use Websocket\Exceptions\ExceptionWebsocketServer;

/**
 * Class for work with socket server
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
class WebsocketServer extends Socket
{
        /** @var INT STATE_STOP     Constant for server state - stop */
    const STATE_STOP    = 0;

        /** @var INT STATE_RUN      Constant for server state - run */
    const STATE_RUN     = 1;

        /** @var INT STATE_PAUSE    Constant for server state - pause */
    const STATE_PAUSE   = 2;

        /** @var array $listState      List server states */
    private static array $listState = [self::STATE_STOP, self::STATE_RUN, self::STATE_PAUSE];

        /** @var int $state       Server state */
    private int $state = self::STATE_RUN;

        /** @var resource $resource     Resource handler to socket */
    private $resource;

        /** @var callable $acceptExceptionHandler       Handler for accept exception */
    private $acceptExceptionHandler;

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
     * Binds a name to a socket
     *
     * @return WebsocketServer
     *
     * @throws ExceptionSocketErrors
     */
    private function bind(): WebsocketServer
    {
        if (!socket_bind($this->resource, $this->address(), $this->port())) {
            ExceptionSocketErrors::generate($this->resource);
        }
        return $this;
    }

    /**
     * Listens for a connection on a socket
     *
     * @param int $backlog
     *
     * @return WebsocketServer
     *
     * @throws ExceptionSocketErrors
     */
    private function listen(int $backlog = 0): WebsocketServer
    {
        if (!socket_listen($this->resource, $backlog)) {
            ExceptionSocketErrors::generate($this->resource);
        }
        return $this;
    }

    /**
     * Setup server state
     *
     * @param int $state
     *
     * @return WebsocketServer
     *
     * @throws ExceptionWebsocketServer
     */
    public function setState(int $state): WebsocketServer
    {
        if (!in_array($state, self::$listState, true)) {
            throw new ExceptionWebsocketServer("Unknown state - $state", ExceptionWebsocketServer::__UNKNOWN_STATE);
        }

        $this->state = $state;

        return $this;
    }

    /**
     * Get server state
     *
     * @return int
     */
    public function getState(): int
    {
        return $this->state;
    }

    /**
     * @param callable $handler
     *
     * @return
     */
    public function setAcceptExceptionHandler(callable $handler): WebsocketServer
    {
        $this->acceptExceptionHandler = $handler;
        return $this;
    }

    /**
     * @param callable $connectionHandler
     * @param int $backlog
     * @param int $wait
     *
     * @throws ExceptionSocketErrors
     */
    public function run(callable $connectionHandler, int $backlog = 0, int $wait = 100)
    {
        $this->bind()->listen($backlog);

        while($this->state !== self::STATE_STOP) {
            if ($this->state !== self::STATE_PAUSE
                && ($socket = @socket_accept($this->resource)) !== false) {
                try {
                    $connectionHandler($this, $socket);
                } catch (\Exception $e) {
                    $handler = $this->acceptExceptionHandler;
                    if (is_callable($handler)) {
                        $handler($e);
                    }
                }
            }

            usleep($wait);
        }
    }
}