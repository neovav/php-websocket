<?php
namespace Websocket\Exceptions;

class ExceptionSocketErrors extends \Exception
{
    public static function generate($resource)
    {
        $errorCode = socket_last_error($resource);
        $errorText = socket_strerror($errorCode);
        throw new ExceptionSocketErrors($errorText, $errorCode);
    }
}