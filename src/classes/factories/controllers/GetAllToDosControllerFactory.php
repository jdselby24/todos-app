<?php

namespace Todo\factories\controllers;


use Psr\Container\ContainerInterface;
use Todo\controllers\GetAllToDosController;

class GetAllToDosControllerFactory
{
    /**
     * Creates a new GetAllToDosController with ToDoModel injected
     *
     * @param ContainerInterface $container
     * @return GetAllToDosController A new GetAllToDosController 
     */
    public function __invoke(ContainerInterface $container) : GetAllToDosController
    {
        $model = $container->get('ToDoModel');
        return new GetAllToDosController($model);
    }
}