<?php
namespace TODO\Loggers;

use Monolog\Logger;
use Logentries\Handler\LogentriesHandler;

/**
 * Class LoggerLE
 *
 * @package TODO\Loggers
 *
 * @author  Robin Saar
 */
class LoggerLE {

    const CLASS_NAME = 'TODO\Loggers\LoggerLE';

    /** @var \Monolog\Logger */
    public $logger;

    public function __construct() {

        $this->logger = new Logger('BakaTest');
        $this->logger->pushHandler(new LogentriesHandler('TOKEN HERE'));
    }

}