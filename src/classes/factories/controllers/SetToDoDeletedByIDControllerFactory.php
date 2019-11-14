<?php

namespace Todo\factories\controllers;

use Psr\Container\ContainerInterface;
use Todo\controllers\SetToDoDeletedByIDController;

class SetToDoDeletedByIDControllerFactory
{
    public function __invoke(ContainerInterface $container) : SetToDoDeletedByIDController
    {
        $model = $container->get('ToDoModel');
        return new SetToDoDeletedByIDController($model);
    }
}