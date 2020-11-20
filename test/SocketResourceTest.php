<?php
namespace WebsocketTest;

use Websocket\Constants\SocketDomains as Domain;
use Websocket\Constants\SocketProtocols as Protocol;
use Websocket\Constants\SocketTypes as Type;
use Websocket\SocketResource;

class SocketResourceTest  extends \PHPUnit\Framework\TestCase
{
    /**
     * @var array $result
     * @var int $domain
     * @var int $type
     * @var int $protocol
     * @var resource $resource
     *
     * @dataProvider providerConstructSucc
     *
     * @throws
     */
    public function testConstructSucc(array $result, int $domain = Domain::AF_INET, int $type = Type::SOCK_STREAM, int $protocol = Protocol::TCP, $resource = null)
    {
        $class = new SocketResource($domain, $type, $protocol, $resource);
        $assert = [
            $class->domain(),
            $class->type(),
            $class->protocol(),
            get_resource_type($class->resource()),
        ];
        $this->assertEquals($result, $assert);
    }

    public function providerConstructSucc() {
        $data = [
            [[Domain::AF_INET, Type::SOCK_STREAM, Protocol::TCP, 'Socket']],
            [[Domain::AF_INET, Type::SOCK_STREAM, Protocol::TCP, 'Socket'], Domain::AF_INET],
            [[Domain::AF_INET, Type::SOCK_STREAM, Protocol::TCP, 'Socket'], Domain::AF_INET, Type::SOCK_STREAM],
            [[Domain::AF_INET, Type::SOCK_STREAM, Protocol::TCP, 'Socket'], Domain::AF_INET, Type::SOCK_STREAM, Protocol::TCP],
            [[Domain::AF_INET6, Type::SOCK_STREAM, Protocol::TCP, 'Socket'], Domain::AF_INET6],
            [[Domain::AF_INET6, Type::SOCK_STREAM, Protocol::TCP, 'Socket'], Domain::AF_INET6, Type::SOCK_STREAM],
            [[Domain::AF_INET6, Type::SOCK_STREAM, Protocol::TCP, 'Socket'], Domain::AF_INET6, Type::SOCK_STREAM, Protocol::TCP],
        ];
        return $data;
    }
}