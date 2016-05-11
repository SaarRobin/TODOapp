<?php

include_once("../vendor/autoload.php");
include_once("../library/bootstrap.php");
session_start();

try {
    $container->getRouter()->init();
} catch (Exception $exception) {
    // Catch your exceptions here
    $view = $container->getView();
    echo $view->render(
        __DIR__ . '/../library/TODO/Views/error.php',
        ['errorMessage' => $exception->getMessage()]
    );
}
