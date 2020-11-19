<?php
namespace Websocket\Constants;

/**
 * Constants for socket options
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
class SocketOptions
{
        /** @var int DEBUG      Reports whether debugging information is being recorded. */
    const DEBUG = SO_DEBUG;

        /** @var int BROADCAST      Reports whether transmission of broadcast messages is supported.  */
    const BROADCAST = SO_BROADCAST;

        /** @var int REUSEADDR      Reports whether local addresses can be reused.  */
    const REUSEADDR = SO_REUSEADDR;

        /** @var int REUSEPORT      Reports whether local ports can be reused.  */
    const REUSEPORT = SO_REUSEPORT;

        /** @var int KEEPALIVE      Reports whether connections are kept active with periodic transmission of messages.
         *                          If the connected socket fails to respond to these messages,
         *                          the connection is broken and processes writing to that
         *                          socket are notified with a SIGPIPE signal.
         */
    const KEEPALIVE = SO_KEEPALIVE;

        /** @var array LINGER       Reports whether the socket lingers on socket_close() if data is present.
         *                          By default, when the socket is closed, it attempts to send all unsent data.
         *                          In the case of a connection-oriented socket,
         *                          socket_close() will wait for its peer to acknowledge the data.
         *
         *                          If l_onoff is non-zero and l_linger is zero, all the unsent data
         *                          will be discarded and RST (reset) is sent to the peer
         *                          in the case of a connection-oriented socket.
         *
         *                          On the other hand, if l_onoff is non-zero and l_linger is non-zero,
         *                          socket_close() will block until all the data is sent or
         *                          the time specified in l_linger elapses. If the socket is non-blocking,
         *                          socket_close() will fail and return an error.
         */
    const LINGER = SO_LINGER;

        /** @var int OOBINLINE      Reports whether the socket leaves out-of-band data inline.  */
    const OOBINLINE = SO_OOBINLINE;

        /** @var int SNDBUF         Reports the size of the send buffer.  */
    const SNDBUF = SO_SNDBUF;

        /** @var int RCVBUF         Reports the size of the receive buffer.  */
    const RCVBUF = SO_RCVBUF;

        /** @var int ERROR          Reports information about error status and clears it.   */
    const ERROR = SO_ERROR;

        /** @var int TYPE           Reports the socket type (e.g. SOCK_STREAM) */
    const TYPE = SO_TYPE;

        /** @var int DONTROUTE      Reports whether outgoing messages bypass the standard routing facilities. */
    const DONTROUTE = SO_DONTROUTE;

        /** @var int RCVLOWAT       Reports the minimum number of bytes to process for socket input operations.  */
    const RCVLOWAT = SO_RCVLOWAT;

        /** @var array RCVTIMEO     Reports the timeout value for input operations.   */
    const RCVTIMEO = SO_RCVTIMEO;

        /** @var array SNDTIMEO     Reports the timeout value specifying the amount of time that
         *                          an output function blocks because flow control
         *                          prevents data from being sent.
         */
    const SNDTIMEO = SO_SNDTIMEO;

        /** @var int SNDLOWAT       Reports the minimum number of bytes to process for socket output operations. */
    const SNDLOWAT = SO_SNDLOWAT;

        /** @var int TCP_NODELAY    Reports whether the Nagle TCP algorithm is disabled.  */
    const TCP_NODELAY = TCP_NODELAY;

        /** @var array MCAST_JOIN_GROUP         Joins a multicast group.  */
    const MCAST_JOIN_GROUP = MCAST_JOIN_GROUP;

        /** @var array MCAST_LEAVE_GROUP        Leaves a multicast group.  */
    const MCAST_LEAVE_GROUP = MCAST_LEAVE_GROUP;

        /** @var array MCAST_BLOCK_SOURCE       Blocks packets arriving from a specific source to
         *                                      a specific multicast group, which must have been previously joined.
         */
    const MCAST_BLOCK_SOURCE = MCAST_BLOCK_SOURCE;

        /** @var array MCAST_UNBLOCK_SOURCE     Unblocks (start receiving again) packets arriving from a specific
         *                                      source address to a specific multicast group,
         *                                      which must have been previously joined.
         */
    const MCAST_UNBLOCK_SOURCE = MCAST_UNBLOCK_SOURCE;

        /** @var array MCAST_JOIN_SOURCE_GROUP  Receive packets destined to a specific multicast group whose
         *                                      source address matches a specific value.
         */
    const MCAST_JOIN_SOURCE_GROUP = MCAST_JOIN_SOURCE_GROUP;

        /** @var array MCAST_LEAVE_SOURCE_GROUP  Stop receiving packets destined to a specific multicast group
         *                                      whose source address matches a specific value.
         */
    const MCAST_LEAVE_SOURCE_GROUP = MCAST_LEAVE_SOURCE_GROUP;

        /** @var int IP_MULTICAST_IF            The outgoing interface for IPv4 multicast packets.   */
    const IP_MULTICAST_IF = IP_MULTICAST_IF;

        /** @var int IPV6_MULTICAST_IF          The outgoing interface for IPv6 multicast packets. */
    const IPV6_MULTICAST_IF = IPV6_MULTICAST_IF;

        /** @var int IP_MULTICAST_LOOP          The multicast loopback policy for IPv4 packets,
         *                                      which determines whether multicast packets sent by this socket also
         *                                      reach receivers in the same host that have joined the same
         *                                      multicast group on the outgoing interface used by this socket.
         *                                      This is the case by default.
         */
    const IP_MULTICAST_LOOP = IP_MULTICAST_LOOP;

        /** @var int IPV6_MULTICAST_LOOP        Analogous to IP_MULTICAST_LOOP, but for IPv6. */
    const IPV6_MULTICAST_LOOP = IPV6_MULTICAST_LOOP;

        /** @var int IP_MULTICAST_TTL           The time-to-live of outgoing IPv4 multicast packets.
         *                                      This should be a value between 0 (don't leave the interface) and 255.
         *                                      The default value is 1 (only the local network is reached).
         */
    const IP_MULTICAST_TTL = IP_MULTICAST_TTL;

        /** @var int IPV6_MULTICAST_HOPS        Analogous to IP_MULTICAST_TTL, but for IPv6 packets.
         *                                      The value -1 is also accepted, meaning the route default should be used.
         */
    const IPV6_MULTICAST_HOPS = IPV6_MULTICAST_HOPS;
}