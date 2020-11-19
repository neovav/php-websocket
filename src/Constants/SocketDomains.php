<?php
namespace Websocket\Constants;

/**
 * Constants for socket domains
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