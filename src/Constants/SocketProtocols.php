<?php
namespace Websocket\Constants;

class SocketProtocols
{
        /** @var int IP         Internet protocol */
    const IP = 0;

        /** @var int ICMP       Internet control message protocol */
    const ICMP = 1;

        /** @var int ICMP       Gateway-gateway protocol */
    const GGP = 3;

        /** @var int TCP        Transmission control protocol */
    const TCP = 6;

        /** @var int EGP        Exterior gateway protocol */
    const EGP = 8;

        /** @var int PUP        PARC universal packet protocol */
    const PUP = 12;

        /** @var int UDP        User datagram protocol */
    const UDP = 17;

        /** @var int HMP        Host monitoring protocol */
    const HMP = 20;

        /** @var int XNS_IDP    Xerox NS IDP */
    const XNS_IDP = 22;

        /** @var int RDP        "reliable datagram" protocol */
    const RDP = 27;

        /** @var int RDP        Internet protocol IPv6 */
    const IPV6 = 41;

        /** @var int RDP        Routing header for IPv6 */
    const IPV6_ROUTE = 43;

        /** @var int IPV6_FRAG  Fragment header for IPv6 */
    const IPV6_FRAG = 44;

        /** @var int ESP        Encapsulating security payload */
    const ESP = 50;

        /** @var int ESP        Authentication header */
    const AH = 51;

        /** @var int ESP        ICMP for IPv6 */
    const IPv6_ICMP = 58;

        /** @var int IPV6_NONXT No next header for IPv6 */
    const IPV6_NONXT = 59;

        /** @var int IPV6_OPTS  Destination options for IPv6 */
    const IPV6_OPTS = 60;

        /** @var int IPV6_OPTS  MIT remote virtual disk */
    const RVD = 66;
}