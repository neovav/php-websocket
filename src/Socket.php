<?php
namespace Websocket;

use Websocket\Exceptions\ExceptionSocket;
use Websocket\Exceptions\ExceptionSocketErrors;

class Socket
{
    const READ_TYPE_BINARY = PHP_BINARY_READ;
    const READ_TYPE_NORMAL = PHP_NORMAL_READ;

    private SocketResource $resource;

    private string $address;

    private int $port;

    private bool $isConnect = false;

    private array $options = [];

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
     * Destructor of the Socket class
     */
    public function __destruct()
    {
        if ($this->isConnect()) {
            $this->close();
        }
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

    /**
     * Establish connect with remote service
     *
     * @return Socket
     */
    protected function _connect()
    {
        $resource = $this->resource->resource();
        $result = socket_connect($resource, $this->address, $this->port);
        $this->isConnect = true;
        return $this;
    }

    /**
     * Disconnect with remote service
     *
     * @return Socket
     */
    public function close()
    {
        $result = socket_close($this->resource->resource());
        $this->isConnect = false;
        return $this;
    }

    /**
     * Check connection status
     *
     * @return bool
     */
    public function isConnect(): bool
    {
        return $this->isConnect;
    }

    /**
     * Read data from socket
     *
     * @param int $length
     * @param int $type
     *
     * @return string
     *
     * @throws ExceptionSocket|ExceptionSocketErrors
     */
    public function read(int $length, int $type = self::READ_TYPE_BINARY): string
    {
        if (!$this->isConnect()) {
            $this->_connect();
        }

        if ($type !== self::READ_TYPE_BINARY && $type !== self::READ_TYPE_NORMAL) {
            throw new ExceptionSocket("Unknown read type - $type", ExceptionSocket::__UNKNOWN_READ_TYPE);
        }
        $resource = $this->resource->resource();

        $result = socket_read($resource, $length, $type);

        if (is_bool($result) && !$result) {
            ExceptionSocketErrors::generate($resource);
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
        if (!$this->isConnect()) {
            $this->_connect();
        }

        $resource = $this->resource->resource();
        if (empty($length)) {
            $length = mb_strlen($data);
        }

        $result = socket_write ( $resource, $data, $length);

        if (is_bool($result) && !$result) {
            ExceptionSocketErrors::generate($resource);
        }

        return $result;
    }
}