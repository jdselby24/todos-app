<?php

namespace Todo\controllers;

use Todo\models\ToDoModel;

use Slim\Http\Request;
use Slim\Http\Response;

class UpdateToDoByIDController
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
     * Method for updating a todo by its ID
     *
     * @param Request $req Request object
     * @param Response $res Response object
     * @param array $args Arguments
     * @return Response Response object
     */
    public function __invoke(Request $req, Response $res, array $args) : Response
    {
        $todo_id = $req->getParsedBody()['todo_id'];
        $todo_name = $req->getParsedBody()['todo_name'];
        $success = $this->model->updateToDoByID($todo_id, $todo_name);

        $response = [
            "success" => $success,
            "message" => "",
            "request" => $req->getParsedBody()
        ];

        if($success === true) {
            $response['message'] = "Successfully updated Todo: $todo_id with name $todo_name";
            return $res->withJson($response, 202);
        } else {
            $response['message'] = "DATABASE ERROR: Could not update todo: $todo_id";
            return $res->withJson($response, 500);
        }
    }
}