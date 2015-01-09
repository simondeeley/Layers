<?php

/**
 * ExceptionHandler.php
 *
 * This file is part of the Layers package
 *
 * @author Simon Deeley
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Layers\Handler;


class ExceptionHandler {

    public function handle($exception)
    {
    $traceline = "#%s %s(%s): %s(%s)<br />";
    $msg = "<html>
    <head><title>Oops! Something has gone wrong.</title></head>
    <body><h1>Ooops!</h1>
    <h2>%s</h2>
    <p>%s in %s on line %d</p>
    <h2>Stack trace:</h2>
    <blockquote>%s</blockquote>
    </body></html>";

    // alter your trace as you please, here
    $trace = $exception->getTrace();
    foreach ($trace as $key => $stackPoint) {
        // I'm converting arguments to their type
        // (prevents passwords from ever getting logged as anything other than 'string')
        $trace[$key]['args'] = array_map('gettype', $trace[$key]['args']);
    }

    // build your tracelines
    $result = array();
    foreach ($trace as $key => $stackPoint) {
        $result[] = sprintf(
            $traceline,
            $key,
            @$stackPoint['file'],
            @$stackPoint['line'],
            $stackPoint['function'],
            implode(', ', $stackPoint['args'])
        );
    }
    // trace always ends with {main}
    $result[] = '#' . ++$key . ' {main}';

    // write tracelines into main template
    $msg = sprintf(
        $msg,
        get_class($exception),
        $exception->getMessage(),
        $exception->getFile(),
        $exception->getLine(),
        implode("\n ", $result)
    );

    // log or echo as you please
    print $msg;
    exit();
    }
}