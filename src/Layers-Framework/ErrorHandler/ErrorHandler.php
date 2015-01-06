<?php

/**
 * ErrorHandler.php
 *
 * This file is part of the Layers package
 *
 * @author Simon Deeley
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Layers\ErrorHandler;

use Symfony\Component\VarDumper\VarDumper;
use Symfony\Component\VarDumper\Cloner\VarCloner;
use Symfony\Component\VarDumper\Dumper\CliDumper;
use Symfony\Component\VarDumper\Dumper\HtmlDumper;


/**
 * ErrorHandler.php
 *
 * Handles PHP errors and returns the output to the user
 */
class ErrorHandler {
    
    /**
     * Constructor
     *
     */
    public function __construct() {
        
        VarDumper::setHandler(function($var) {
            $cloner = new VarCloner();
            $dumper = 'cli' === PHP_SAPI ? new CliDumper() : new HtmlDumper();
            $dumper->dump($cloner->cloneVar($var));
        });
    }
    
    /**
     * Handles a PHP error
     *
     */
    public function handle($errno, $errstr, $errfile, $errline, $errcontext) {
        
        if (!(error_reporting() & $errno)) {
            // This error code is not included in error_reporting
            return;
        }
        
        $exception = new \Exception(sprintf('%s in %s at line %d', $errstr, $errfile, $errline), $errno);
        
        VarDumper::dump($exception);
        
        return true;        
    }
}