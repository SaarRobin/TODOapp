<?php


namespace TODO\Repositories;


use Erply\SDK\DI\Container;
use TODO\Database\DatabaseConnection;
use TODO\Loggers\LoggerLE;
use TODO\Loggers\LoggerLY;

/**
 * Class SignInRepo
 *
 * @package TODO\Repositories
 *
 * @author  Robin Saar <robin.saar@erply.com>
 */
class SignInRepo {

    const CLASS_NAME = 'TODO\Repositories\SignInRepo';

    /** @var DatabaseConnection */
    private $databaseConnection;

    /** @var LoggerLE */
    protected $logger;

    /** @var LoggerLY */
    protected $loggly;


    /**
     * @param \Erply\SDK\DI\Container $container
     *
     * @throws \Erply\SDK\Exceptions\DI\RequiredDependencyMissingException
     */
    public function __construct(Container $container) {

        /** @var DatabaseConnection databaseConnection */
        $this->databaseConnection = $container->get(DatabaseConnection::CLASS_NAME, Container::SHARED_INSTANCE);
        $this->logger = $container->get(LoggerLE::CLASS_NAME);
        $this->loggly = $container->get(LoggerLY::CLASS_NAME);

    }

    /**
     * @param $username
     * @param $password
     * @param $browser
     *
     * @return bool
     *
     * @author Robin Saar <robin.saar@erply.com>
     */
    public function login($username, $password, $browser) {

        $sql = 'SELECT user_id, user_name, user_pass, country FROM users WHERE user_name = :username';

        $statement = $this->databaseConnection->link->prepare($sql);
        $statement->bindParam(':username', $username, \PDO::PARAM_STR);
        $statement->execute();
        $result = $statement->fetch(\PDO::FETCH_ASSOC);

        if (!empty($result) && $result['user_pass'] == md5($password)) {
            $_SESSION['user'] = $result['user_id'];
            $logData = [];
            $logData['action'] = 'login';
            $logData['country'] = $result['country'];
            $logData['browser'] = $browser;
            $toLog = json_encode($logData);
            $this->logger->logger->addInfo($toLog);
            $this->loggly->loggly->addInfo($toLog);

            return true;
        }

        return false;

    }

}