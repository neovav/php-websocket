# php-websocket-client
Web socket client

Sample:
```bash
php -f samples/web-client.php
```

Test
1. Goto folder test
```bash
cd test
```

2. Exec unit test
```bash
..\vendor\bin\phpunit SocketResourceTest.php
```

or 

1. Build docker container
```bash
docker build -t php-websocket .
```

2. Launch unit test into docker container 
```bash
docker run php-websocket bash -c "cd /app/test && ..\vendor\bin\phpunit SocketResourceTest.php"
```