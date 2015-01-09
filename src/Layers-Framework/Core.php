<?php

/**
 * Core.php
 *
 * This file is part of the Layers package
 *
 * @author Simon Deeley
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Layers;

use Layers\Collection\CollectionInterface;
use Layers\Handler\ExceptionHandler;

/**
 * Core
 *
 * The Core Application
 */
abstract class Core
{
    /**
     * @var $layers
     */
    protected $layers;

    /**
     * @var $shared
     */
    protected $shared;

    /**
     * @var $workingDir
     */
    protected $workingDir;

    /**
     * Sets the Collection
     *
     * @var CollectionInterface $collection     An object implementing CollectionInterface
     */
    public function setLayers(CollectionInterface $layers)
    {
        $this->layers = $layers;
    }

    /**
     * Returns the current collection
     *
     */
    public function getLayers()
    {
        return $this->collection;
    }

    /**
     * Sets the shared object to $shared
     *
     * @var mixed $shared   An object to share between layers
     */
    public function setShared($shared)
    {
        $this->shared = $shared;
    }

    /**
     * Returns the shared object
     *
     */
    public function getShared()
    {
        return $this->shared;
    }

    /**
     * Sets the exception_handler
     *
     */
    public function handleExceptions()
    {
        set_exception_handler(array(new ExceptionHandler(), 'handle'));
    }

    /**
     * Runs the application
     *
     */
    public function run()
    {
        while (false !== $layer = $this->layers->extract()) {
            call_user_func($layer, $this->shared);
        }
    }

    /**
     * Sets the working directory
     * Only available at instantiation
     *
     * @var string $path     A valid path
     */
    protected function setWorkingDir($path)
    {
        return realpath($path);
    }
}
