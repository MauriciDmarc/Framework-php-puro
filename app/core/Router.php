<?php

class Router {
    private $routes = [];

    public function addRoute($route, $callback) {
        $this->routes[$route] = $callback;
    }

    public function dispatch($route, $params) {
        if (isset($this->routes[$route])) {
            // Chama o controlador ou a função correspondente, passando os parâmetros
            call_user_func($this->routes[$route], $params);
        } else {
            // Se a rota não for encontrada, você pode redirecionar ou mostrar um erro 404
            echo "Página não encontrada!";
        }
    }
}
