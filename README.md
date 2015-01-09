LAYERS
======

[![SensioLabsInsight](https://insight.sensiolabs.com/projects/3a360f7f-4cff-41a8-b4ae-10b1bf031be4/small.png)](https://insight.sensiolabs.com/projects/3a360f7f-4cff-41a8-b4ae-10b1bf031be4)

A dive into the world of micro frameworks

Please note this repository is entirely experimental - please feel free to fork and suggest improvements!


### Usage
The idea is to build a simple iterator that takes a set of instructions that have been prioritised to execute in a certain order and then execute those functions at run time.

Here's a full-working example
```php    
require_once __DIR__ . '/../app/bootstrap.php';
require_once __DIR__ . '/../app/AppCore.php';

use Layers\Collection\LayerCollection;

$app = new AppCore(true);
$app->setShared(new array());

$collection = new LayerCollection();

$collection
    ->add(function () use (&$container) {
        $container['response'] = array();
    },110)
    ->add(function () use (&$container) {
        $container['response'][1] = 'Second';  
    },100)
    ->add(function () use (&$container) {
        $container['response'][2] = 'First';  
    },109)
    ->add(function () use (&$container) {
        $container['response'][3] = 'Third';  
    },100)
    ->add(function () use (&$container) {
        var_dump($container);
    })
;

$app->setLayers($collection);
$app->run();
```
Breaking it down, we have the following happening:
1. First we initialise a new instance of AppCore
2. We then create a simple array for sharing - a dependency injection container using `$app->setShared()` You could use something more sophisticated but an array is the simplest of all and will suffice for the demo.
3. Next we need to build our collection of functions, that's where the `new LayerCollection()` comes in. It has a simple method `add` to push items onto the priority stack.
4. You'll notice that we've used closures to create the callbacks for when the stack is run. The referenced 'container' is then accessible to all functions in the app as it is executed.
5. Finally, we add the collection to the app and hit run!
