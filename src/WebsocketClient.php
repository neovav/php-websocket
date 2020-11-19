<?php
namespace Websocket;

use Websocket\Exceptions\ExceptionSocket;
use Websocket\Exceptions\ExceptionSocketErrors;
use Websocket\Exceptions\ExceptionSocketIO;

class WebsocketClient extends SocketIO
{
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
     * @return Socket
     */
    public function connect()
    {
        $result = socket_connect($this->resource, $this->address(), $this->port());
        $this->isConnected = true;
        return $this;
    }

    /**
     * Disconnect with remote service
     *
     * @return Socket
     */
    public function close()
    {
        socket_close($this->resource);
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
     * @throws ExceptionSocket|ExceptionSocketErrors|ExceptionSocketIO
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
     * @throws ExceptionSocketErrors
     */
    public function write(string $data, int $length = 0): int
    {
        if (!$this->isConnect()) {
            $this->connect();
        }

        return $this->write($data, $length);
    }
}