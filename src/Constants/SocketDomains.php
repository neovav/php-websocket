<?php
namespace Websocket\Constants;

class SocketDomains
{
        /** @var int AF_INET 	IPv4 Internet based protocols. TCP and UDP are common protocols of this protocol family. */
    const AF_INET = AF_INET;

        /** @var int AF_INET6 	IPv6 Internet based protocols. TCP and UDP are common protocols of this protocol family. */
    const AF_INET6 = AF_INET6;

        /** @var int AF_UNIX 	Local communication protocol family. High efficiency and low overhead make it a great form of IPC (Interprocess Communication). */
    const AF_UNIX = AF_UNIX;

        /** @var array LIST_DOMAINS - list domains for socket */
    const LIST_DOMAINS = [self::AF_INET, self::AF_INET6, self::AF_UNIX];
}