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
        $success = $this->model->setToDoCompleteByID($todo_id);

        $response = [
            "success" => $success,
            "message" => "",
            "request" => $req->getParsedBody()
        ];

        if($success === true) {
            $response['message'] = "Successfully set Todo: $todo_id completed";
            return $res->withJson($response, 200);
        } else {
            $response['message'] = "DATABASE ERROR: Could not set todo: $todo_id complete";
            return $res->withJson($response, 500);
        }
    }
}