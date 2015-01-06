<?php

/**
 * Priority.php
 *
 * This file is part of the Layers package
 *
 * @author Simon Deeley
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Layers\Priority;

use Layers\Priority\PriorityInterace;

/**
 * Priority.php
 *
 * Allows priorities to be set on the stack
 */
class Priority implements PriorityInterface {
    
    const LAST = 1;
    const FIRST = 900;
    
    public static function normalize($priority) {
        
        $priority = (int) $priority;
        
        if ($priority > self::UPPER_LIMIT || $priority < self::LOWER_LIMIT) {
            throw new \RuntimeException(sprintf(
                'You must specify an integer between %d and %d for the priority',
                self::LOWER_LIMIT,
                self::UPPERLIMIT
            ));
        }
        
        return $priority;
        
    }
}