LAYERS
======

[![SensioLabsInsight](https://insight.sensiolabs.com/projects/3a360f7f-4cff-41a8-b4ae-10b1bf031be4/small.png)](https://insight.sensiolabs.com/projects/3a360f7f-4cff-41a8-b4ae-10b1bf031be4)

A dive into the world of micro frameworks

Please note this repository is entirely experimental - please feel free to fork and suggest improvements!


### Usage
```php    
$app->add(function () use (&$container) {
        
    $container['output'] = 'Hello World!/n';
        
}, PRIORITY::FIRST);
    
$app->add(function() use (&$container) {
        
    echo $container['output'];
        
}, PRIORITY::LAST);
```