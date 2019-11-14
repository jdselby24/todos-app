<?php

namespace Todo\models;

use PDO;

class ToDoModel
{

    private $db;

    /**
     * Constructor
     *
     * @param PDO $db PDO Database object
     */
    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    /**
     * Function for adding a todo to the DB with a name
     *
     * @param string $name The name of the todo
     * @return boolean DB Success
     */
    public function addToDo(string $name) : bool {
        $statement = "INSERT INTO `todos` (`name`) VALUES (:name)";
        $query = $this->db->prepare($statement);
        $query->bindParam(":name", $name, PDO::PARAM_STR, 512); 
        return $query->execute();
    }
}