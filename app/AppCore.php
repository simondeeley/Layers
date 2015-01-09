<?php

/**
 * AppCore.php
 *
 * This file is part of the Layers package
 *
 * @author Simon Deeley
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Layers\Core;

class AppCore extends Core {

    public function __construct($debug = false)
    {
        if (true === $debug) {
            $this->handleExceptions();
        }
        
        $this->workingDir = $this->setWorkingDir(__DIR__);
    }
    
    public function getConfigDir()
    {
        return $this->workingDir . '/config/';
    }
}