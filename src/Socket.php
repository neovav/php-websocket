<?php
namespace Websocket;

use Websocket\Exceptions\ExceptionSocket;
use Websocket\Exceptions\ExceptionSocketErrors;

/**
 * Constants for work with socket
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
class Socket
{
        /** @var int READ_TYPE_BINARY   Mode read from socket - binary */
    const READ_TYPE_BINARY = PHP_BINARY_READ;

        /** @var int READ_TYPE_BINARY   Mode read from socket - normal */
    const READ_TYPE_NORMAL = PHP_NORMAL_READ;

        /** @var SocketResource $resource  Class with socket resource */
    private SocketResource $resource;

        /** @var string $address The address parameter is either an IPv4 address in dotted-quad notation (e.g. 127.0.0.1)
         *                       if socket is AF_INET, a valid IPv6 address (e.g. ::1)
         *                       if IPv6 support is enabled and socket is AF_INET6 or the pathname
         *                       of a Unix domain socket, if the socket family is AF_UNIX
         */
    private string $address;

        /** @var int $port      The port parameter is only used and is mandatory when connecting to an AF_INET or
         *                      an AF_INET6 socket, and designates the port on the remote host
         *                      to which a connection should be made.
         */
    private int $port;

        /** @var array $options  List options for socket*/
    private array $options = [];

        /** @var bool $isBlockMode  Mode socket: nonblock or block */
    private bool $isBlockMode = false;

    /**
     * Constructor of the Socket class
     *
     * @param SocketResource $resource
     * @param string $address
     * @param int $port
     */
    public function __construct(SocketResource $resource, string $address = '127.0.0.1', int $port = 80)
    {
        $this->resource = $resource;
        $this->address = $address;
        $this->port = $port;
    }

    /**
     * Setup block mode for socket
     *
     * @param bool $mode
     *
     * @return Socket
     *
     * @throws ExceptionSocketErrors
     */
    public function setBlockMode(bool $mode = true): Socket
    {
        $resource = $this->resource->resource();
        if ((!$mode && !socket_set_nonblock($resource))
            || ($mode && !socket_set_block($resource))) {
            ExceptionSocketErrors::generate($resource);
        }

        $this->isBlockMode = $mode;
        return $this;
    }

    /**
     * Get block mode for socket
     *
     * @return bool
     */
    public function getBlockMode(): bool
    {
        return $this->isBlockMode;
    }

    /**
     * Setup options for socket using level
     *
     * @param int $level
     * @param int $name
     * @param mixed $value
     *
     * @return Socket
     */
    public function setOption(int $level, int $name, $value): Socket
    {
        if (empty($this->options[$level])) {
            $this->options[$level] = [];
        }
        $this->options[$level][$name] = $value;
        return $this;
    }

    /**
     * Check options for level
     *
     * @param int $level
     * @return bool
     */
    public function isOptionsLevel(int $level): bool
    {
        return !empty($this->options[$level]);
    }

    /**
     * Get options for socket
     *
     * @param int $level;
     *
     * @return array
     *
     * @throws ExceptionSocket
     */
    public function getOptions(int $level)
    {
        if (!$this->isOptionsLevel($level)) {
            throw new ExceptionSocket("Option level - $level is absent", ExceptionSocket::__THIS_OPTION_LEVEL_IS_ABSENT);
        }
        return $this->options[$level];
    }

    /**
     * Get SocketResource class
     *
     * @return SocketResource
     */
    public function resource(): SocketResource
    {
        return $this->resource;
    }

    /**
     * Get address
     *
     * @return string
     */
    public function address(): string
    {
        return $this->address;
    }

    /**
     * Get port number
     *
     * @return int
     */
    public function port(): int
    {
        return $this->port;
    }


}