<?php

/**
 * FrozenLayerCollection.php
 *
 * This file is part of the Layers package
 *
 * @author Simon Deeley
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Layers;


class FrozenLayerCollection extends LayerCollection
{
    public function __construct(LayerCollection $collection)
    {
        $this->setExtractFlags(self::EXTR_DATA);
                
        $collection->rewind();
        
        while ($collection->valid()) {
            $this->insert($collection->extract(), $collection->key());
        }
    }
    
    public function __call($method, $args)
    {
        if (!in_array($method, array('extract'))) {
            throw new \Exception(sprintf('You cannot call method \'%s\' on %s', $method, __CLASS__));
        }
    }

}
