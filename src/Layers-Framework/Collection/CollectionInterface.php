<?php

/**
 * CollectionInterface.php
 *
 * This file is part of the Layers package
 *
 * @author Simon Deeley
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Layers\Collection;

/**
 * LayerCollectionInterface
 *
 * Defines methods that allow access to properties of a LayerCollection
 */
interface CollectionInterface
{
    /**
     * Builds the layered kernel
     *
     * @return SplFixedArray Array of callable objects
     */
    //public function build();

    /**
     * Registers a loader to build a heap from a file
     *
     * @var $loader     A valid file loader
     * @return $this Return $this object
     */
    //public function registerLoader($loader);

    /**
     * Adds a callable to the heap
     *
     * @return $this             Return $this object
     * @throws \BuilderException if an error occurs
     */
    public function add($layer);
}
