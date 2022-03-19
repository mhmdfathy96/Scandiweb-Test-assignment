<?php

namespace app\controllers;

use app\bussinessLayer\logic\CommonLogic;

class Router
{
    public static $router;
    private $getRoutes = [];
    private $postRoutes = [];


    public function __construct()
    {
        self::$router = $this;
    }

    public function get($url, $fn)
    {
        $this->getRoutes[$url] = $fn;
    }

    public function post($url, $fn)
    {
        $this->postRoutes[$url] = $fn;
    }

    public function resolve()
    {
        $currentUrl = $_SERVER['PATH_INFO'] ?? '/';
        $method = $_SERVER['REQUEST_METHOD'] ?? '/';
        if ($method === 'GET') {
            $fn = $this->getRoutes[$currentUrl] ?? null;
        } else {
            $fn = $this->postRoutes[$currentUrl] ?? null;
        }

        if ($fn) {
            $callback = CommonLogic::fromNonToStatic($fn); ///$fn was returning an array also but index 0 was a string not an object
            call_user_func($callback, $this);
        } else {
            echo "Page not found";
        }
    }

    public function renderView($view, $params = [])
    {
        foreach ($params as $key => $value) {
            $$key = $value;
        }
        ob_start();
        include_once __DIR__ . "/../view/products/$view.php";
        $content = ob_get_clean();
        include_once __DIR__ . "/../view/_layout.php";
    }
}