<?php
namespace Websocket;

use InternalFunctionsDebug\Debug;

function socket_last_error(...$args) {return SocketDebug::exec(__FUNCTION__, $args);}

function socket_strerror(...$args) {return SocketDebug::exec(__FUNCTION__, $args);}

function socket_create(...$args) {return SocketDebug::exec(__FUNCTION__, $args);}

function socket_set_block(...$args) {return SocketDebug::exec(__FUNCTION__, $args);}

function socket_read(...$args) {return SocketDebug::exec(__FUNCTION__, $args);}

function socket_write(...$args) {return SocketDebug::exec(__FUNCTION__, $args);}

function socket_connect(...$args) {return SocketDebug::exec(__FUNCTION__, $args);}

function socket_close(...$args) {return SocketDebug::exec(__FUNCTION__, $args);}

function socket_bind(...$args) {return SocketDebug::exec(__FUNCTION__, $args);}

function socket_listen(...$args) {return SocketDebug::exec(__FUNCTION__, $args);}

function socket_accept(...$args) {return SocketDebug::exec(__FUNCTION__, $args);}

function socket_shutdown(...$args) {return SocketDebug::exec(__FUNCTION__, $args);}

class SocketDebug extends Debug {};