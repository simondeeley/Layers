LAYERS
======

A dive into the world of micro frameworks

Please note this repository is entirely experimental - please feel free to fork and suggest improvements!


### Usage
    
    $app->add(function () use (&$container) {
        
       $container['output'] = 'Hello World!/n';
        
    }, PRIORITY::FIRST);
    
    $app->add(function() use (&$container) {
        
        echo $container['output'];
        
    }, PRIORITY::LAST);

