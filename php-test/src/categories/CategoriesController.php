<?php

class CategoriesController
{
    public function __construct(private CategoriesGateway $gateway) {}
    public function processRequest(string $method): void
    {
        $this->processCollectionRequest($method);
    }

    private function processCollectionRequest(string $method): void
    {
        switch ($method) {
            case "GET":
                echo json_encode($this->gateway->getAll(), JSON_PRETTY_PRINT);
                break;
        }
    }
}
