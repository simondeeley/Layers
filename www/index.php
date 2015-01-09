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
require_once __DIR__ . '/../app/AppCore.php';

use Pimple\Container;
use Layers\Collection\LayerCollection;
use Acme\AcmeDemo\AcmeDemo;

$app = new AppCore(true);
$app->setShared(new Container());

$collection = new LayerCollection();

$collection
    ->add(function () use (&$container) {
        $container['response'] = array();
    },110)
    ->add(function () use (&$container) {
        $container['response'][1] = 'Second';  
    },100)
    ->add(function () use (&$container) {
        $container['response'][2] = 'First';  
    },109)
    ->add(function () use (&$container) {
        $container['response'][3] = 'Third';  
    },100)
    ->add(function () use (&$container) {
        $demo = new AcmeDemo($container);
        $demo->foo();
    })
;

$app->setLayers($collection);
$app->run();
