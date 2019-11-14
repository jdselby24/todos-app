<?php

namespace Todo\factories\controllers;

use Psr\Container\ContainerInterface;
use Todo\controllers\AddToDoController;

class AddToDoControllerFactory
{
    /**
     * Creates a new AddToDoController and injects ToDoModel
     *
     * @param ContainerInterface $container DIC
     * @return AddToDoController A new AddToDoController
     */
    public function __invoke(ContainerInterface $container) : AddToDoController
    {
        $model = $container->get('ToDoModel');
        return new AddToDoController($model);
    }
}