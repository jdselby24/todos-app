<?php

namespace Todo\factories\controllers;

use Psr\Container\ContainerInterface;
use Todo\controllers\HomepageController;

class HomepageControllerFactory
{

    public function __invoke(ContainerInterface $container) : HomepageController
    {
        $renderer = $container->get('renderer');
        return new HomepageController($renderer);
    }
}