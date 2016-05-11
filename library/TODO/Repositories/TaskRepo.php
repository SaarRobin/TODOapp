<?php


namespace TODO\Repositories;


use Erply\SDK\DI\Container;
use TODO\Database\DatabaseConnection;
use Erply\SDK\Config\Config;
use TODO\Loggers\LoggerLE;
use TODO\Loggers\LoggerLY;

class TaskRepo {

    const CLASS_NAME = 'TODO\Repositories\TaskRepo';

    /** @var Config */
    public $config;

    /** @var DatabaseConnection */
    protected $databaseConnection;

    protected $tableName;

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
        $this->config = $container->getConfig();
        $this->tableName = $this->config->get('table_name');
        $this->logger = $container->get(LoggerLE::CLASS_NAME);
        $this->loggly = $container->get(LoggerLY::CLASS_NAME);
    }

    /**
     * @return array
     *
     */
    public function getTasks() {

        // Doesn't get tasks correctly
        $sql = 'SELECT id, user_id, taskName, comments, createDate, dueDate FROM tasks WHERE user_id = :userID';
        $statement = $this->databaseConnection->link->prepare($sql);
        $statement->bindParam(':userID', $_SESSION['user']);
        $statement->execute();
        $tasks = $statement->fetchAll(\PDO::FETCH_ASSOC);

        return $tasks;
    }

    /**
     * @param $taskName
     * @param $comments
     * @param $dueDate
     *
     * @throws \Exception
     *
     */
    public function insetTask($taskName, $comments, $dueDate) {

        try {
            $sql = 'INSERT INTO tasks(
                user_id, taskName, comments, createDate, dueDate
                ) VALUES (:user_id, :taskName, :comments, :createDate, :dueDate )';
            $statement = $this->databaseConnection->link->prepare($sql);
            $statement->bindParam(':user_id', $_SESSION['user'], \PDO::PARAM_INT);
            $statement->bindParam(':taskName', $taskName, \PDO::PARAM_STR);
            $statement->bindParam(':comments', $comments, \PDO::PARAM_STR);
            $statement->bindParam(':createDate', date('Y-m-d'), \PDO::PARAM_STR);
            $statement->bindParam(':dueDate', $dueDate, \PDO::PARAM_STR);
            $statement->execute();
            $logData = [];
            $logData['action'] = 'task';
            $logData['result'] = 'create';
            $toLog = json_encode($logData);
            $this->logger->logger->addInfo($toLog);
            $this->loggly->loggly->addInfo($toLog);
        } catch (\PDOException $exception) {
            $this->logger->logger->addError('Task not created');
            $this->loggly->loggly->addError('Task not created');
            throw new \PDOException($exception);
        }

    }

    /**
     * @param $ID
     *
     * @throws \Exception
     *
     */
    public function deleteTask($ID) {

        try {
            $sql = 'DELETE FROM ' . $this->tableName . ' WHERE id = ' . intval($ID) . '';
            $statement = $this->databaseConnection->link->prepare($sql);
            $statement->execute();
            $logData = [];
            $logData['action'] = 'task';
            $logData['result'] = 'delete';
            $toLog = json_encode($logData);
            $this->logger->logger->addInfo($toLog);
            $this->loggly->loggly->addInfo($toLog);
        } catch (\Exception $exception) {
            $this->logger->logger->addError('Task not deleted');
            $this->loggly->loggly->addError('Task not deleted');
            throw new \Exception($exception);
        }
    }

}