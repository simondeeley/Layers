<?php

/**
 * PriorityInterface.php
 *
 * This file is part of the Layers package
 *
 * @author Simon Deeley
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Layers\Priority;


interface PriorityInterface {
    
    const LOWER_LIMIT = 0;
    const UPPER_LIMIT = 1000;
    
    /**
     * Normalize priority to ensure it is within boundaries
     *
     * @var int $priority   The priority to normalize
     * @return int
     */
    public static function normalize($priority);

}