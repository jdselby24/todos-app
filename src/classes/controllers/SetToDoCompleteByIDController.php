<?php

namespace Todo\controllers;

use Todo\models\ToDoModel;

use Slim\Http\Request;
use Slim\Http\Response;

class SetToDoCompleteByIDController
{
    /**
     * A ToDoModel
     *
     * @var ToDoModel
     */
    private $model;

    /**
     * Constructor
     *
     * @param ToDoModel $model ToDoModel to be injected
     */
    public function __construct(ToDoModel $model)
    {
        $this->model = $model;
    }

    /**
     * Method for setting a todo complete by its ID
     *
     * @param Request $req Request object
     * @param Response $res Response object
     * @param array $args Arguments
     * @return Response Response object
     */
    public function __invoke(Request $req, Response $res, array $args) : Response
    {
        $todo_id = $req->getParsedBody()['todo_id'];
        $todo = $this->model->getToDoByID($todo_id);
        $todo_get_success = $todo['success'];
        $todo_data = $todo['data_todo'];

        if($todo_get_success !== true) {
            $response['message'] = "DATABASE ERROR: Could not change todo state: $todo_id for complete";
            return $res->withJson($response, 500);
        }

        if($todo_data['completed'] == 0) {
            $success = $this->model->setToDoCompleteByID($todo_id, 1);
        } else {
            $success = $this->model->setToDoCompleteByID($todo_id,0);
        }

        $response = [
            "success" => $success,
            "message" => "",
            "request" => $req->getParsedBody()
        ];

        if($success === true) {
            $response['message'] = "Successfully set Todo: $todo_id completed"; 
            $response['info'] = $todo_data['completed'];
            return $res->withJson($response, 202);
        } else {
            $response['message'] = "DATABASE ERROR: Could not change todo state: $todo_id for complete";
            return $res->withJson($response, 500);
        }
    }
}