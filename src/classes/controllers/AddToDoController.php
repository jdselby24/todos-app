<?php

namespace Todo\controllers;

use Todo\models\ToDoModel;

use Slim\Http\Request;
use Slim\Http\Response;

class AddToDoController
{

    private $model;

    /**
     * Constrcutor with model dependecy injection
     *
     * @param ToDoModel $model A ToDoModel object
     */
    public function __construct(ToDoModel $model)
    {
        $this->model = $model;
    }

    /**
     * Adds a Todo to the DB and returns a JSON response 
     *
     * @param Request $req Request object
     * @param Response $res Response object
     * @param array $args Arguments
     * @return Response Reponse with JSON
     */
    public function __invoke(Request $req, Response $res, array $args) : Response
    {
        $newToDoName = $req->getParsedBody()['todo'];
        $addSuccess = $this->model->addToDo($newToDoName);

        if($addSuccess === true) {
            $response = ['message' => "Todo '$newToDoName' was added", 'success' => true];
            return $res->withJson($response, 200);
        } else {
            $response = ['message' => "ERROR WITH DB", 'success' => false];
            return $res->withJson($response, 500);
        }
    }
}