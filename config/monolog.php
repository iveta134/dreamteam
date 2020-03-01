<?php
require __DIR__ . '/../vendor/autoload.php';
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

// create a log channel
$log = new Logger('name');
$log->pushHandler(new StreamHandler('logs/mylog.log', Logger::WARNING));

// add records to the log
$log->warning('Our index page accessed');
$log->error('Bar');
// echo "Should have logged something";