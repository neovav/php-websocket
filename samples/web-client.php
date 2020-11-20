<?php
ini_set ('set_time_limit', 0);
ini_set ('memory_limit', '-1');
mb_internal_encoding("UTF-8");

require __DIR__ . '/../vendor/autoload.php';

$socketResource = new \Websocket\SocketResource();
$host = 'www.google.com';
$userAgent = 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:82.0) Gecko/20100101 Firefox/82.0';
$client = new \Websocket\WebsocketClient($socketResource, $host);
$data = "GET / HTTP/1.1
Host: $host
User-Agent: $userAgent
Accept: text/html
Pragma: no-cache
Cache-Control: no-cache
Connection: Close\r\n\r\n";

\Websocket\SocketDebug::setHandler('socket_write', function($name, $arguments) {
    var_dump($name);
    var_dump($arguments);
});

\Websocket\SocketDebug::setHandler('socket_read', function($name, $arguments, $result) {
    var_dump($name);
    var_dump($arguments);
    var_dump($result);
}, false);

try {
    $request = $client->write($data);
    $response = $client->read(10240);

    // var_dump($response);
} catch (\Exception $e) {
    var_dump($e);
}

$client->close();