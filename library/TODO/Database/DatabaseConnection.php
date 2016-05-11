<?php


namespace TODO\Database;


use Erply\SDK\Config\Config;
use Erply\SDK\DI\Container;

/**
 * Class DatabaseConnection
 *
 * @package TODO\Database
 *
 * @author  Robin Saar <robin.saar@erply.com>
 */
class DatabaseConnection {

    const CLASS_NAME = 'TODO\Database\DatabaseConnection';

    /**
     * @var \PDO
     */
    public $link;

    /**
     * @var Config
     */
    private $config;


    /**
     * PHP 5 allows developers to declare constructor methods for classes.
     * Classes which have a constructor method call this method on each newly-created object,
     * so it is suitable for any initialization that the object may need before it is used.
     *
     * Note: Parent constructors are not called implicitly if the child class defines a constructor.
     * In order to run a parent constructor, a call to parent::__construct() within the child constructor is required.
     *
     * param [ mixed $args [, $... ]]
     *
     * @param \Erply\SDK\DI\Container $container
     *
     * @link http://php.net/manual/en/language.oop5.decon.php
     */
    function __construct(Container $container) {


        $this->config = $container->getConfig();


        try {
            $this->link = new \PDO(
                "mysql:host=" . $this->config->get('serverAddress') .
                ";dbname=" . $this->config->get("databaseName"),
                $this->config->get("db_username"),
                $this->config->get("db_password")
            );
        } catch (\PDOException $Exception) {
            echo $Exception->getMessage();
        }

    }


}