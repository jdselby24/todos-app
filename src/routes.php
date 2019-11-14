<?php

use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;

return function (App $app) {
    $container = $app->getContainer();

    $app->get('/', 'GetAllToDosController');
    $app->post('/add', 'AddToDoController');
    $app->post('/complete', 'SetToDoCompleteByIDController');

};
