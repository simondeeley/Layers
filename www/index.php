<?php

/**
 * index.php
 *
 * This file is part of the Layers package
 *
 * @author Simon Deeley
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

require_once __DIR__ . '/../app/bootstrap.php';

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Pimple\Container;
use Layers\Layers\Application;
use Layers\Priority\Priority;

$app = new Application(new Container(), null);

$app->add(function () use (&$container) {
        $container['response'] = 'Hello World';
    },
    PRIORITY::FIRST
);

$app->add(function () use (&$container) {
        
        $response = new Response();
        $response->setContent($container['response']);
        $response->send();
    },
    PRIORITY::LAST
);


$app->run();