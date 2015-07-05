<?php
/**
 * Laravel - A PHP Framework For Web Artisans
 *
 * @package  Laravel
 * @author   Taylor Otwell <taylorotwell@gmail.com>
 */

/*
|--------------------------------------------------------------------------
| Register The Auto Loader
|--------------------------------------------------------------------------
|
| Composer provides a convenient, automatically generated class loader for
| our application. We just need to utilize it! We'll simply require it
| into the script here so that we don't have to worry about manual
| loading any of our classes later on. It feels nice to relax.
|
*/

require __DIR__.'/../laravel/bootstrap/autoload.php';

/*
|--------------------------------------------------------------------------
| Turn On The Lights
|--------------------------------------------------------------------------
|
| We need to illuminate PHP development, so let us turn on the lights.
| This bootstraps the framework and gets it ready for use, then it
| will load up this application so that we can run it and send
| the responses back to the browser and delight our users.
|
*/

$app = require_once __DIR__.'/../laravel/bootstrap/app.php';

<<<<<<< HEAD
$app->bind('path.public', function() {
    return __DIR__;
});

=======
>>>>>>> 22be403ff560b2bebfd1c48a952bcdee7ef708da
/*
|--------------------------------------------------------------------------
| Run The Application
|--------------------------------------------------------------------------
|
<<<<<<< HEAD
| Once we have the application, we can simply call the run method,
| which will execute the request and send the response back to
=======
| Once we have the application, we can handle the incoming request
| through the kernel, and send the associated response back to
>>>>>>> 22be403ff560b2bebfd1c48a952bcdee7ef708da
| the client's browser allowing them to enjoy the creative
| and wonderful application we have prepared for them.
|
*/

<<<<<<< HEAD
=======
/*
Set Public Path
 */
$app->bind('path.public', function() {
    return __DIR__;
});

>>>>>>> 22be403ff560b2bebfd1c48a952bcdee7ef708da
$kernel = $app->make('Illuminate\Contracts\Http\Kernel');

$response = $kernel->handle(
	$request = Illuminate\Http\Request::capture()
);

$response->send();

$kernel->terminate($request, $response);
