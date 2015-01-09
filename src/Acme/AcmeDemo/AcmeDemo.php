<?php

/**
 * AcmeDemo.php
 *
 * This file is part of the Layers package
 *
 * @author Simon Deeley
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Acme\AcmeDemo;


class AcmeDemo {
    
    protected $container;

    public function __construct ($container)
    {
        $this->container = $container;
    }
    
    public function foo()
    {
        dump($this->container['response']);
    }
}