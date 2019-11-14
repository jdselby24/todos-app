<?php

use Slim\App;
use Todo\factories\controllers\AddToDoControllerFactory;
use Todo\factories\controllers\GetAllToDosControllerFactory;
use Todo\factories\controllers\SetToDoCompleteByIDControllerFactory;
use Todo\factories\controllers\SetToDoDeletedByIDControllerFactory;
use Todo\factories\models\ToDoModelFactory;
use Todo\factories\controllers\UpdateToDoByIDControllerFactory;

return function (App $app) {
    $container = $app->getContainer();

    // view renderer
    $container['renderer'] = function ($c) {
        $settings = $c->get('settings')['renderer'];
        return new \Slim\Views\PhpRenderer($settings['template_path']);
    };

    // monolog
    $container['logger'] = function ($c) {
        $settings = $c->get('settings')['logger'];
        $logger = new \Monolog\Logger($settings['name']);
        $logger->pushProcessor(new \Monolog\Processor\UidProcessor());
        $logger->pushHandler(new \Monolog\Handler\StreamHandler($settings['path'], $settings['level']));
        return $logger;
    };

    /**
     * DB Object
     */
    $container['db'] = function($c) : PDO {
        $db = new PDO('mysql:host=127.0.0.1;dbname=todo', 'root', 'password');
        $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        return $db;
    };

    $container['ToDoModel'] = new ToDoModelFactory();
    $container['AddToDoController'] = new AddToDoControllerFactory();
    $container['GetAllToDosController'] = new GetAllToDosControllerFactory();
    $container['SetToDoCompleteByIDController'] = new SetToDoCompleteByIDControllerFactory();
    $container['SetToDoDeletedByIDController'] = new SetToDoDeletedByIDControllerFactory();
    $container['UpdateToDoByIDController'] = new UpdateToDoByIDControllerFactory();
};
