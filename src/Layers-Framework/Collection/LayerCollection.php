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

namespace Layers\Collection;

/**
 * LayerCollection
 *
 * Class which builds the layered order
 */
class LayerCollection implements CollectionInterface, \Countable, \IteratorAggregate
{
    /**
     * @var $serial
     */
    protected $serial = PHP_INT_MAX;

    /**
     * @var $queue
     */
    protected $queue;

    /**
     * Constructor
     *
     */
    public function __construct()
    {
        $this->queue = new \SplPriorityQueue();
    }

    /**
     * {@inheritdoc}
     *
     */
    public function extract()
    {
        if (false === $this->queue->valid()) {
            return false;
        }

        return $this->queue->extract();
    }

    /**
     * {@inheritdoc}
     *
     */
    public function add($object, $priority = 0, $uniquekey = null)
    {
        if (!is_callable($object)) {
            throw new \InvalidArgumentException(sprintf(
                'The object passed to LayerBuilder::add must be callable. An object of type \'%s\' was given',
                gettype($object)
            ));
        }

        if (false === is_string($uniquekey) && false === is_null($uniquekey)) {
            throw new \InvalidArgumentException(sprintf(
                'The value for $uniquekey must be a string or null, \'%s\' given',
                gettype($uniquekey)
            ));
        }

        $this->queue->insert(
            $object,
            array($priority, $this->serial--, $uniquekey)
        );

        return $this;
    }

    /**
     * Returns the number of items in the queue
     *
     */
    public function count()
    {
        return $this->queue->count();
    }

    /**
     * Returns the queued collection
     *
     */
    public function getIterator()
    {
        $this->checkIfEmpty();

        return clone $this->queue;
    }

    /**
     * Checks to see if the queue is empty
     *
     */
    private function checkIfEmpty()
    {
        if (true === $this->queue->isEmpty()) {
            throw new \UnexpectedValueException('The LayerCollection is empty!');
        }
    }
}
