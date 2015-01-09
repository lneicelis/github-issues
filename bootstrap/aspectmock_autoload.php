<?php

define('LARAVEL_START', microtime(true));

/*
|--------------------------------------------------------------------------
| Register The Composer Auto Loader
|--------------------------------------------------------------------------
|
| Composer provides a convenient, automatically generated class loader
| for our application. We just need to utilize it! We'll require it
| into the script here so that we do not have to worry about the
| loading of any our classes "manually". Feels great to relax.
|
*/

require __DIR__.'/../vendor/autoload.php';

/*
|--------------------------------------------------------------------------
| Include The Compiled Class File
|--------------------------------------------------------------------------
|
| To dramatically increase your application's performance, you may use a
| compiled class file which contains all of the classes commonly used
| by a request. The Artisan "optimize" is used to create this file.
|
*/

$kernel = \AspectMock\Kernel::getInstance();
$kernel->init([
	'appDir'    => __DIR__ . '/../',
	'cacheDir'  => '/storage/aspect_mock',
	'includePaths' => [
		__DIR__ . '/../src',
		__DIR__ . '/../vendor/laravel',
		__DIR__ . '/../vendor/knplabs/github-api/lib/Github/Api',
	],
	'vendorDir' => __DIR__ . '/../vendor',
    'excludePaths' => [__DIR__ . '/../tests'] // tests dir should be excluded
]);