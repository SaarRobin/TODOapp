<?php


namespace TODO\Loggers;

use Monolog\Logger;
use Monolog\Handler\LogglyHandler;
use Monolog\Formatter\LogglyFormatter;

class LoggerLY {

    const CLASS_NAME = 'TODO\Loggers\LoggerLY';

    /** @var \Monolog\Logger  */
    public $loggly;

    public function __construct() {

        $this->loggly = new Logger('Bakatoo');
        $this->loggly->pushHandler(new LogglyHandler('TOKEN HERE', Logger::INFO));

    }
}