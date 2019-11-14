<?php 

namespace Todo\factories\models;

use Psr\Container\ContainerInterface;
use Todo\models\ToDoModel;

class ToDoModelFactory
{
    /**
     * Creates a new ToDoModel with DB dependency
     *
     * @param ContainerInterface $container DIC
     * @return ToDoModel The new ToDoMode object
     */
    public function __invoke(ContainerInterface $container) : ToDoModel
    {
        $db = $container->get('db');
        return new ToDoModel($db);
    }
}