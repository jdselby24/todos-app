<?php

namespace Todo\factories\controllers;

use Psr\Container\ContainerInterface;
use Todo\controllers\UpdateToDoByIDController;

class UpdateToDoByIDControllerFactory
{
    public function __invoke(ContainerInterface $container) : UpdateToDoByIDController
    {
        $model = $container->get('ToDoModel');
        return new UpdateToDoByIDController($model);
    }
}