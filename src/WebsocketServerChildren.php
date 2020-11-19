<?php
namespace Websocket;

class WebsocketServerChildren extends SocketIO
{
    const SHUTDOWN_READ     = 0;
    const SHUTDOWN_WRITE    = 1;
    const SHUTDOWN_ALL      = 2;

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
     * Close open connection
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