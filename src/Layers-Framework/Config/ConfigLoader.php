<?php

/**
 * ConfigLoader.php
 *
 * This file is part of the Layers package
 *
 * @author Simon Deeley
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Layers\Config;

use Symfony\Component\Config\Loader\FileLoader;
use Symfony\Component\Config\Loader\LoaderResolver;
use Symfony\Component\Config\Loader\DelegatingLoader;
use Symfony\Component\Config\ConfigCache;
use Symfony\Component\Config\Resource\FileResource;

/**
 * ConfigLoader.php
 *
 * Loads a Stack configuration into memory
 */
class ConfigLoader {

    public function load(array $loaders) {
        
        $cachePath = __DIR__.'/cache/appStack.php';

        // the second argument indicates whether or not you want to use debug mode
        $stackCache = new ConfigCache($cachePath, true);
        
        if (!$stackCache->isFresh()) {
            
            $loaderResolver = new LoaderResolver($loaders);
            $delegatingLoader = new DelegatingLoader($loaderResolver);

            $delegatingLoader->load(__DIR__.'/config/stack.yml');
        
        
            // the code for the UserMatcher is generated elsewhere
            $code = ...;
        
            $stackCache->write($code, $resources);
        }
        
        // you may want to require the cached code:
        require $cachePath;
    }

}