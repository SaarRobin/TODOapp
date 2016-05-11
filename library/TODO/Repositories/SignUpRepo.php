<?php


namespace TODO\Repositories;


use Erply\SDK\DI\Container;
use TODO\Database\DatabaseConnection;
use TODO\Loggers\LoggerLE;



        use TODO\Loggers\LoggerLY;



/**
 * Class SignUpRepo
 *
 * @package TODO\Repositories
 *
 * @author  Robin Saar <robin.saar@erply.com>
 */
class SignUpRepo {

    const CLASS_NAME = 'TODO\Repositories\SignUpRepo';

    /** @var DatabaseConnection */
    private $databaseConnection;

    /** @var LoggerLE */
    private $logger;

    /** @var  LoggerLY */
    private $loggly;

    public function __construct(Container $container) {

        $this->databaseConnection = $container->get(DatabaseConnection::CLASS_NAME, Container::SHARED_INSTANCE);
        $this->logger = $container->get(LoggerLE::CLASS_NAME);
        $this->loggly = $container->get(LoggerLY::CLASS_NAME);

    }

    /**
     * @param $username
     * @param $password
     * @param $email
     * @param $country
     * @param $browser
     *
     * @return bool
     *
     * @author Robin Saar <robin.saar@erply.com>
     */
    public function signUp($username, $password, $email, $country, $browser) {

        $sql = 'INSERT INTO users ( user_name, user_pass, user_email, country) VALUES (:username, :password, :email, :country)';

        try {
            $statement = $this->databaseConnection->link->prepare($sql);
            $statement->bindParam(':username', $username, \PDO::PARAM_STR);
            $statement->bindParam(':password', md5($password), \PDO::PARAM_STR);
            $statement->bindParam(':email', $email, \PDO::PARAM_STR);
            $statement->bindParam(':country', $country, \PDO::PARAM_STR);
            $statement->execute();

            $logData = [];
            $logData['action'] = 'signup';
            $logData['country'] = $country;
            $logData['browser'] = $browser;
            $toLog = json_encode($logData);
            $this->logger->logger->addInfo($toLog);
            $this->loggly->loggly->addInfo($toLog);

            return true;
        } catch (\PDOException $ex) {
            $this->logger->logger->addError('SignUp' . $ex->getMessage() . '');
            $this->loggly->loggly->addError('SignUp' . $ex->getMessage() . '');

            return false;
        }

    }
}