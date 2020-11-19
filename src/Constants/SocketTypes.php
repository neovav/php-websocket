<?php
namespace Websocket\Constants;

class SocketTypes
{
        /** @var int SOCK_STREAM 	Provides sequenced, reliable, full-duplex, connection-based byte streams.
         *                          An out-of-band data transmission mechanism may be supported.
         *                          The TCP protocol is based on this socket type.
         */
    const SOCK_STREAM = SOCK_STREAM;

        /** @var int SOCK_DGRAM 	Supports datagrams (connectionless, unreliable messages of a fixed maximum length).
         *                          The UDP protocol is based on this socket type.
         */
    const SOCK_DGRAM = SOCK_DGRAM;

        /** @var int SOCK_SEQPACKET 	Provides a sequenced, reliable, two-way connection-based data transmission path
         *                              for datagrams of fixed maximum length; a consumer is required to read an entire
         *                              packet with each read call.
         */
    const SOCK_SEQPACKET = SOCK_SEQPACKET;

        /** @var int SOCK_RAW 	Provides raw network protocol access.
         *                      This special type of socket can be used to manually construct any type of protocol.
         *                      A common use for this socket type is to perform ICMP requests (like ping).
         */
    const SOCK_RAW = SOCK_RAW;

        /** @var int SOCK_RDM 	Provides a reliable datagram layer that does not guarantee ordering.
         *                      This is most likely not implemented on your operating system.
         */
    const SOCK_RDM = SOCK_RDM;

        /**
         * List types for socket
         */
    const LIST_TYPES = [self::SOCK_STREAM, self::SOCK_DGRAM, self::SOCK_SEQPACKET, self::SOCK_RAW, self::SOCK_RDM];
}