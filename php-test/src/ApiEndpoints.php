<?php

class ApiEndpoints
{
    public function __construct()
    {
        $database = new Database("localhost", "test-php", "phpT", "phpT");
        $parts  = explode("/", $_SERVER["REQUEST_URI"]);

        if ($parts[2] == "products") {
            $gateway = new ProductGateway($database);
            $controller = new ProductController($gateway);
            $id = $parts[3] ?? null;
            $controller->processRequest($_SERVER["REQUEST_METHOD"], $id);
            exit;
        }

        if ($parts[2] == "categories") {
            $gateway = new CategoriesGateway($database);
            $controller = new CategoriesController($gateway);
            $id = $parts[3] ?? null;
            $controller->processRequest($_SERVER["REQUEST_METHOD"]);
            exit;
        }

        http_response_code(404);
    }
}
