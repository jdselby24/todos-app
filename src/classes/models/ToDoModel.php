<?php

namespace Todo\models;

use PDO;

class ToDoModel
{

    private $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }
    
}