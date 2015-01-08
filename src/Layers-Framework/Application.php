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

namespace Layers;



/**
 * Application.php
 *
 * Layers Application
 */
class Application
{
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
     * @var $fileloaders
     */
    protected $fileloaders = array();

    /**
     * Constructor
     *
     */
    public function __construct(LayerCollection $stack, $container = null)
    {
        $this->stack     = $stack;
        $this->container = $container;
    }

    /**
     * Loads stack using provided $loader
     *
     */
    public function registerLoader(LoaderInterface $loader)
    {
        $this->fileloaders[] = $loader;
    }

    public function loader()
    {
        return $this->loader->load(array(new YamlUserLoader($locator)));
    }

    /**
     * Runs the application
     *
     */
    public function run()
    {
        foreach ($this->stack as $layer) {
            call_user_func($layer, $this->container);
        }
    }
}
