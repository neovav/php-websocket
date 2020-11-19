<?php
namespace Websocket;

use Websocket\Exceptions\ExceptionSocketErrors;

class WebsocketServer extends Socket
{
    const STATE_STOP    = 0;
    const STATE_RUN     = 1;
    const STATE_PAUSE   = 2;

    private int $status = self::STATE_RUN;

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
     * @param callable $function
     * @param int $backlog
     * @param int $wait
     *
     * @throws ExceptionSocketErrors
     */
    public function run(callable $function, int $backlog = 0, int $wait = 500)
    {
        $this->bind()->listen($backlog);

        while($this->status !== self::STATE_STOP) {
            if ($this->status !== self::STATE_PAUSE
                && ($socket = socket_accept($this->resource)) !== false) {
                $function($socket);
            }

            usleep($wait);
        }
    }
}