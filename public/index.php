<?php

// Inclui o autoloader
require_once '../core/autoload.php';

// Cria uma instância do roteador
$router = new Router();

// Adiciona a rota para a home
$router->addRoute('home', function() {
    $controller = new HomeController();
    $controller->index();
});

// Adiciona a rota para a rota 'user' com parâmetros
$router->addRoute('user', function($params) {
    $controller = new UserController();
    $controller->show($params);
});

// Obtém o parâmetro da URL (ex: ?url=home)
$route = isset($_GET['url']) ? $_GET['url'] : 'home'; // Rota padrão é 'home'

// Recupera parâmetros adicionais (se existirem)
$params = array_diff_key($_GET, array('url' => '')); // Remove o 'url' da lista de parâmetros

// Chama o roteador para processar a rota
$router->dispatch($route, $params);
