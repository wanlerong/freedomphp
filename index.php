<?php
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

require_once './vendor/autoload.php';

$loggerModel=new Logger('test');

$log = new Logger('name');
$log->pushHandler(new StreamHandler('/tmp/monolog.txt', Logger::WARNING));

// add records to the log
$log->addWarning('Foo',array('Freedom!'));
$log->addError('Bar');


?>
