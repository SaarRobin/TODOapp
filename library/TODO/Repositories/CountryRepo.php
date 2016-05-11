<?php


namespace TODO\Repositories;


use Erply\SDK\DI\Container;
use TODO\Database\DatabaseConnection;

class CountryRepo {

    const CLASS_NAME = 'TODO\Repositories\CountryRepo';

    /** @var DatabaseConnection */
    private $databaseConnection;

    public function __construct(Container $container) {

        $this->databaseConnection = $container->get(DatabaseConnection::CLASS_NAME, Container::SHARED_INSTANCE);
    }

    /**
     * @return array
     *
     */
    public function getCountries() {

        $sql = 'SELECT countryName, countryCode FROM countries';
        $statement = $this->databaseConnection->link->prepare($sql);
        $statement->execute();

        return $statement->fetchAll(\PDO::FETCH_ASSOC);
    }
}