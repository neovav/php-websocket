<?php
namespace Websocket;

use Websocket\Exceptions\ExceptionSocketErrors;
use Websocket\Exceptions\ExceptionWebsocketServer;

class WebsocketServer extends Socket
{
    const STATE_STOP    = 0;
    const STATE_RUN     = 1;
    const STATE_PAUSE   = 2;

    private static array $listState = [self::STATE_STOP, self::STATE_RUN, self::STATE_PAUSE];

    private int $state = self::STATE_RUN;

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

    public function setState(int $state): WebsocketServer
    {
        if (!in_array($state, self::$listState, true)) {
            throw new ExceptionWebsocketServer("Unknown state - $state", ExceptionWebsocketServer::__UNKNOWN_STATE);
        }

        $this->state = $state;

        return $this;
    }

    public function getState(): int
    {
        return $this->state;
    }

    /**
     * @param callable $function
     * @param int $backlog
     * @param int $wait
     *
     * @throws ExceptionSocketErrors
     */
    public function run(callable $function, int $backlog = 0, int $wait = 100)
    {
        $this->bind()->listen($backlog);

        while($this->state !== self::STATE_STOP) {
            if ($this->state !== self::STATE_PAUSE
                && ($socket = @socket_accept($this->resource)) !== false) {
                $function($this, $socket);
            }

            usleep($wait);
        }
    }
}