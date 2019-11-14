<?php

namespace Todo\controllers;

use Slim\Views\PhpRenderer;
use Slim\Http\Response;
use Slim\Http\Request;
use Psr\Http\Message\ResponseInterface;

class HomepageController
{

    private $renderer;

    public function __construct(PhpRenderer $renderer)
    {
        $this->renderer = $renderer;
    }

    public function __invoke(Request $request, Response $response, array $args) : ResponseInterface
    {
        return $this->renderer->render($response, 'index.phtml', $args);
    }
}