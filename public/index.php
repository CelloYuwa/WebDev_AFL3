<?php

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// Autoload Composer dependencies
require __DIR__.'/../vendor/autoload.php';

// Bootstrap the Laravel application
$app = require_once __DIR__.'/../bootstrap/app.php';

// Create HTTP Kernel
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

// Capture the incoming request
$request = Request::capture();

// Handle the request and send the response
$response = $kernel->handle($request);
$response->send();

// Terminate the kernel (runs shutdown tasks)
$kernel->terminate($request, $response);
