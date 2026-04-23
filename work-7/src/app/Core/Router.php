<?php
namespace App\Core;

class Router {
    public static function dispatch() {
        $action = $_GET['action'] ?? 'home';

        $routes = [
            'home' => ['HomeController', 'index'],
            'menu' => ['MenuController', 'index'],
            'admin' => ['AdminController', 'index'],
            'charts' => ['ChartController', 'show'],
            'files' => ['FileController', 'index'],
            'upload_file' => ['FileController', 'upload'],
            'download_file' => ['FileController', 'download'],
            'delete_file' => ['FileController', 'delete'],
            'api' => ['ApiController', 'handle'],
            'settings' => ['SettingsController', 'index'],
            'update_settings' => ['SettingsController', 'update'],
            'static1' => ['PageController', 'about'],
            'static2' => ['PageController', 'contacts'],
            'fixtures' => ['FixtureController', 'run'],
        ];

        if (array_key_exists($action, $routes)) {
            $controllerName = "App\\Controllers\\" . $routes[$action][0];
            $methodName = $routes[$action][1];
            
            if (class_exists($controllerName)) {
                $controller = new $controllerName();
                if (method_exists($controller, $methodName)) {
                    $controller->$methodName();
                    return;
                }
            }
        }

        // Default or 404
        $controller = new \App\Controllers\HomeController();
        $controller->index();
    }
}
