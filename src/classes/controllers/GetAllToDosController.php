<?php

namespace Todo\controllers;

use Todo\models\ToDoModel;

use Slim\Http\Request;
use Slim\Http\Response;

class GetAllToDosController
{

    private $model;

    /**
     * Constructor injecting ToDoModel
     *
     * @param ToDoModel $model A ToDoModel object
     */
    public function __construct(ToDoModel $model)
    {
        $this->model = $model;
    }

    /**
     * Method for returning all todos as JSON
     *
     * @param Request $req Request object
     * @param Response $res Response object
     * @param array $args Arguments
     * @return Response Response object with JSON
     */
    public function __invoke(Request $req, Response $res, array $args) : Response
    {
        $todos = $this->model->getAllToDos();
        $data = [
            "success" => $todos['success'],
            "message" => "",
            "data" => $todos,
        ];

        if($data['success'] === true) {
            $data['message'] = "Successfuly retreived todos";
            return $res->withJson($data, 200);
        } else {
            $data['message'] = "Error retreiving todos from DB";
            return $res->withJson($data, 500);
        }
    }
}