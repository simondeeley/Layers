<?php

/**
 * bootstrap.php
 *
 * This file is part of the Layers package
 * Licenced under MIT Licence
 *
 * @author Simon Deeley
 * @copyright 02/01/2015 Simon Deeley
 * 
 */


require_once __DIR__ . '/../vendor/autoload.php';

use Layers\ErrorHandler\ErrorHandler;

set_error_handler(array(new ErrorHandler, 'handle'));