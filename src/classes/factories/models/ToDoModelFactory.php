<?php 

namespace Todo\factories\models;

use Psr\Container\ContainerInterface;
use Todo\models\ToDoModel;

class ToDoModelFactory
{
    public function __invoke(ContainerInterface $container) : ToDoModel
    {
        $db = $container->get('db');
        return new ToDoModel($db);
    }
}