<?php

/**
 * | Value                               | Default                   |
 * | ------------------------------------|:-------------------------:|
 * | curl.timeout                        | 45                        |
 * | curl.caCertPath                     | ""   (empty)              |
 * | erply.apiEndpoint                   | https://%s.erply.com/api/ |
 * | erply.apiVersion                    | 1.0                       |
 * | erply.maxRequestsPerBulk            | 100                       |
 * | logger.path                         | "" (empty)                |
 * | logger.fileName                     | date("Y-m-D", time()).log |
 * | logger.setAsDefaultErrorHandler     | true                      |
 * | logger.setAsDefaultExceptionHandler | true                      |
 * | mvc.controllerNamespace             | ''                        |
 */

return [
    'plugin.home'             => __DIR__ . '/../',
    'mvc.controllerNamespace' => 'TODO\Controllers',
    //Localhost Testing
    'serverAddress'           => 'localhost',
    'databaseName'            => 'todo',
    'db_username'             => 'root',
    'db_password'             => 'root',
    'table_name'              => 'tasks'

];
