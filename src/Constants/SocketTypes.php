<?php
namespace Websocket\Constants;

/**
 * Constants for socket types
 *
 * Copyright 2020 neovav. All rights reserved.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License
 *
 * @author Verveda Aleksandr
 * @email neovav@outlook.com
 */
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