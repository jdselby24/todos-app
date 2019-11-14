<?php

use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;

return function (App $app) {
    $container = $app->getContainer();

    $app->get('/get', 'GetAllToDosController');
    $app->post('/add', 'AddToDoController');
    $app->put('/complete', 'SetToDoCompleteByIDController');
    $app->put('/delete', 'SetToDoDeletedByIDController');

};
