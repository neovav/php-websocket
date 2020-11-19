<?php
namespace Websocket;

use Websocket\Constants\SocketDomains as Domain;
use Websocket\Constants\SocketTypes as Type;
use Websocket\Constants\SocketProtocols as Protocol;
use WebSocket\Exceptions\ExceptionSocketResource;

/**
 * Class with socket resource
 */
class SocketResource
{
        /** @var int $domain    The domain parameter specifies the protocol family to be used by the socket. */
    private int $domain;

        /** @var int $type      The type parameter selects the type of communication to be used by the socket. */
    private int $type;

        /** @var int $protocol  The protocol parameter sets the specific protocol within the specified domain
         *                      to be used when communicating on the returned socket
         */
    private int $protocol;

        /** @var Object $resource  Socket resource, also referred to as an endpoint of communication */
    private $resource;

    /**
     * Constructor of class SocketResource
     *
     * @param int $domain       specifies the protocol family to be used by the socket.
     * @param int $type         selects the type of communication to be used by the socket
     * @param int $protocol     specific protocol to be used when communicating
     * @param resource|null $resource
     *
     * @throws ExceptionSocketResource
     */
    public function __construct(
        int $domain = Domain::AF_INET, int $type = Type::SOCK_STREAM, int $protocol = Protocol::TCP, $resource = null
    )
    {
        if (!in_array($domain, Domain::LIST_DOMAINS, true)) {
            throw new ExceptionSocketResource("Is not correct domain - $domain", 0);
        }

        if (!in_array($domain, Type::LIST_TYPES, true)) {
            throw new ExceptionSocketResource("Is not correct type - $type", 0);
        }

        if (!is_null($resource)) {
            if (!is_resource($resource)) {
                throw new ExceptionSocketResource("Is not correct resource", 0);
            }
            $this->resource = $resource;
        } else {
            $this->resource = socket_create($domain, $type, $protocol);

            if ($this->resource === false) {
                $errorCode = socket_last_error();
                $errorText = socket_strerror($errorCode);
                throw new ExceptionSocketResource($errorText, $errorCode);
            }
        }

        $this->domain = $domain;
        $this->type = $type;
        $this->protocol = $protocol;
    }

    /**
     * Return value for socket domain
     *
     * @return int
     */
    public function domain(): int
    {
        return $this->domain;
    }

    /**
     * Return value for socket type
     *
     * @return int
     */
    public function type(): int
    {
        return $this->type;
    }

    /**
     * Return value for socket protocol
     *
     * @return int
     */
    public function protocol(): int
    {
        return $this->protocol;
    }

    /**
     * Return value for socket resource
     *
     * @return
     */
    public function resource()
    {
        return $this->resource;
    }
}