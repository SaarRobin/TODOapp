<?php

$container = new Erply\SDK\DI\Container();

use TODO\Database\DatabaseConnection;
use TODO\Repositories\TaskRepo;
use TODO\Repositories\SignInRepo;
use TODO\Repositories\SignUpRepo;
use TODO\Controllers\SigninController;
use TODO\Controllers\SignupController;
use TODO\Repositories\CountryRepo;
use TODO\Loggers\LoggerLE;
use TODO\Controllers\IndexController;
use TODO\Loggers\LoggerLY;
use TODO\Repositories\BrowserRepo;

$environment = $container->getEnvironment();
$filesystem = $container->getFilesystem();
$config = $container->getConfig();
$environment->detect(isset($_SERVER['SERVER_NAME']) ? $_SERVER['SERVER_NAME'] : 'commandline');
$config->loadConfiguration(__DIR__ . '/../config', $filesystem, $environment);

$container->getRequest()->get->setGetData($_GET);
$container->getRequest()->post->setPostData($_POST);
$container->register(DatabaseConnection::CLASS_NAME, function ($container) {

    return new DatabaseConnection($container);
});
$container->register(TaskRepo::CLASS_NAME, function ($container) {

    return new TaskRepo($container);
});
$container->register(SignInRepo::CLASS_NAME, function ($container) {

    return new SignInRepo($container);
});
$container->register(SignUpRepo::CLASS_NAME, function ($container) {

    return new SignUpRepo($container);
});
$container->register(SigninController::CLASS_NAME, function ($container) {

    return new SigninController($container);
});
$container->register(SignupController::CLASS_NAME, function ($container) {

    return new SignupController($container);
});
$container->register(CountryRepo::CLASS_NAME, function ($container) {

    return new CountryRepo($container);
});
$container->register(LoggerLE::CLASS_NAME, function ($container) {

    return new LoggerLE($container);
});
$container->register(LoggerLY::CLASS_NAME, function ($container) {

    return new LoggerLY($container);
});
$container->register(IndexController::CLASS_NAME, function ($container) {

    return new IndexController($container);
});
$container->register(BrowserRepo::CLASS_NAME, function ($container) {

    return new BrowserRepo($container);
});
