<?php

/**
 * LayerCollection.php
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
 * LayerBuilder
 *
 * Class which builds the HTTP kernel
 */
class LayerCollection extends \SplPriorityQueue implements LayerCollectionInterface
{
    /**
     * @var $serial
     */
    protected $serial = PHP_INT_MAX;
    
    
    /**
     * {@inheritdoc}
     *
     */
    public function build()
    {
                
        return new FrozenLayerCollection($this);

    }

    /**
     * {@inheritdoc}
     *
     */
    public function registerLoader($loader)
    {
    }

    /**
     * {@inheritdoc}
     *
     */
    public function add($object, $priority = 0)
    {
        if (!is_callable($object)) {
            throw new \RuntimeException(sprintf(
                'The object passed to LayerBuilder::add must be callable. An object of type "%s" was given',
                gettype($object)
            ));
        }

        $this->insert(
            $object,
            array($priority, $this->serial--)
        );

        return $this;
    }

    /**
     * {@inheritddoc}
     *
     */
    public function remove($key)
    {
    }
}
