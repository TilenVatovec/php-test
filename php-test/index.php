<?php

declare(strict_types=1);




spl_autoload_register(function ($class) {
    $directories = [
        __DIR__ . '/src/products',
        __DIR__ . '/src/categories',
        __DIR__ . '/src'
    ];

    foreach ($directories as $directory) {
        $file = $directory . '/' . str_replace('\\', '/', $class) . '.php';
        if (file_exists($file)) {
            require $file;
            return true;
        }
    }

    return false;
});


set_exception_handler("ErrorHandler::handleException");

header("Content-type: application/json; charset=UTF-8");
header("Access-Control-Allow-Origin: http://localhost:3000");


new ApiEndpoints();
