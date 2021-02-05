# FCSAPI - FX Price Feeds

#### Update: 2021-02-05

FCSAPI provides real time FX prices with socket and PHP connection, FCS use socket.io on the server-side and workerman framework for PHP client.  These code files help you to get live feeds from servers. Prices update frequency are <1 second to 5 seconds or depends on the currency. 
Get live prices from [fcsapi.com](https://fcsapi.com)

<b> Files </b>
* start.php stablish a connection between your and FCS server.
* receiver.php contain methods that received live prices and log messages.

## Installation

* Install composer if not installed in your machine: https://getcomposer.org/
* Create your work directory.
* Install require workerman dependency in your directory
````
composer require workerman/phpsocket.io
````
* To Start connection between FCS server and your machine run command
````
php start.php start
````

## Basic Usage

````php
<?php

use Workerman\Worker;
use Workerman\Connection\AsyncTcpConnection;
use Workerman\Timer;
require_once __DIR__ . '/vendor/autoload.php';


global $api_key,$currencyList;
$api_key = 'API_KEY'; // Enter your API KEY here,
$currencyList = '1,1984,80,81,7774,7778';  // currency ids


$worker = new Worker();
$worker->onWorkerStart = function() use ($api_key)
{

    $ws_connection = new AsyncTcpConnection("ws://fcsapi.com/v3/?EIO=3&transport=websocket");
    
    $ws_connection->onConnect = function($connection) use ($api_key){
        // Connect API KEY to verify subscription
        $con->send('42["heartbeat","'.$api_key.'"]'); //send api_key
        
        // connect your required Forex IDs with server
        global $currencyList;
        $con->send('42["real_time_join","'.$currencyList.'"]'); //currency list
    };

    // received all response from socket, then direct to it right function.
    $ws_connection->onMessage = function($connection, $data){
        // Response from server received here
        print_r($data);
    };

    // Start Connection
    $ws_connection->connect();
};
Worker::runAll();

````

You can get your API Access Key here : https://fcsapi.com/dashboard

6 currency data is free even without signup. FCS Support 400 FX currency live feeds and 200 Crypto currency.
List of Available currency ids : https://fcsapi.com/assets/socket/socket_support_list.xlsx


### Start.php 
Recommend you to download files and use it, It contain full code also if server discounnet for any reason, it will reconnect you with Backup server.

#### Documentaion
FCS Socket documentation : [fcsapi.com/document/socket-api](https://fcsapi.com/document/socket-api)
<br>Wokerman Framework : [WorkerMan Github](https://github.com/walkor/Workerman)

