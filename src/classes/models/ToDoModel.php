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
        $statement = "INSERT INTO `todos` (`name`) VALUES (:name);";
        $query = $this->db->prepare($statement);
        $query->bindParam(":name", $name, PDO::PARAM_STR, 512); 
        return $query->execute();
    }

    /**
     * Fetch all todos from the DB
     *
     * @return array Array containing the result of the DB query
     */
    public function getAllToDos() : array {
        $statement = "SELECT `id`,`name`,`completed`,`deleted` FROM `todos` WHERE `deleted` = 0;";
        $query = $this->db->prepare($statement);
        $success = $query->execute();
        $data = $query->fetchAll();
        return ["success" => $success, "data_todos" => $data];
    }

    public function getToDoByID(string $id) : array {
        $statement = "SELECT `id`,`name`,`completed` FROM `todos` WHERE `deleted` = 0 AND `id` = :id;";
        $query = $this->db->prepare($statement);
        $query->bindParam(":id", $id, PDO::PARAM_INT, 11);
        $success = $query->execute();
        $data = $query->fetch();
        return ["success" => $success, "data_todo" => $data];
    }

    /**
     * Set a todo complete by its ID
     *
     * @param integer $id An ID of a Todo
     * @return boolean DB Success
     */
    public function  setToDoCompleteByID(int $id, int $state) : bool {
        $statement = "UPDATE `todos` SET `completed` = :state WHERE `id` = :id;";
        $query = $this->db->prepare($statement);
        $query->bindParam(":id", $id, PDO::PARAM_INT, 11);
        $query->bindParam(":state", $state, PDO::PARAM_INT, 1);
        return $query->execute();
    }

    /**
     * Set a todo deleted by its ID
     *
     * @param integer $id An ID of a Todo
     * @return boolean DB Success
     */
    public function  setToDoDeletedByID(int $id) : bool {
        $statement = "UPDATE `todos` SET `deleted` = 1 WHERE `id` = :id;";
        $query = $this->db->prepare($statement);
        $query->bindParam(":id", $id, PDO::PARAM_INT, 11);
        return $query->execute();
    }

    /**
     * Update a todo by its ID
     *
     * @param integer $id An ID of a Todo
     * @param string $name The name to rename todo to
     * @return boolean DB Success
     */
    public function  updateToDoByID(string $id, string $name) : bool {
        $statement = "UPDATE `todos` SET `name` = :name WHERE `id` = :id;";
        $query = $this->db->prepare($statement);
        $query->bindParam(":id", $id, PDO::PARAM_INT, 11);
        $query->bindParam(":name", $name, PDO::PARAM_STR, 512);
        return $query->execute();
    }
}