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