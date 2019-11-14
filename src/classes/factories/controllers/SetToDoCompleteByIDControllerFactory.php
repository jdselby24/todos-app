<?php

namespace Todo\factories\controllers;

use Psr\Container\ContainerInterface;
use Todo\controllers\SetToDoCompleteByIDController;

class SetToDoCompleteByIDControllerFactory
{
    public function __invoke(ContainerInterface $container) : SetToDoCompleteByIDController
    {
        $model = $container->get('ToDoModel');
        return new SetToDoCompleteByIDController($model);
    }
}