<?php

/**
 * Layers.php
 *
 * This file is part of the Layers package
 *
 * @author Simon Deeley
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Layers\Layers;


/**
 * Application.php
 *
 * Layers Application
 */
class Application {
    
    /**
     * @var $stack
     */
    protected $stack;
    
    /**
     * @var $container
     */
    protected $container;

    /**
     * @var $loader
     */
    protected $loader;
    
    /**
     * Constructor
     *
     */
    public function __construct($container, $loader) {
                
        $this->stack     = new \SplPriorityQueue();
        $this->container = $container;
        $this->loader    = $loader;
    }
    
    /**
     * Adds a layer to the stack
     *
     */
    public function add($object, $priority = 0) {
        
        $this->stack->insert(
            $object,
            $priority
        );
        
        return $this;
        
    }
    
    /**
     * Removes a layer from the stack
     *
     */
    public function remove($key) {
        
    }
    
    
    public function run() {
            
        foreach ($this->stack as $layer) {
            call_user_func($layer, $this->container);
        }
    }
    
}