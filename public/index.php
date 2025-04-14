<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FRAMEWORK MVC PHP</title>
</head>
<body class="bg-gray-300">
    <?php
    // Inclui o autoloader
    require_once '../core/autoload.php';
    date_default_timezone_set('America/Sao_Paulo');

    session_start();

    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    // Cria uma instância do roteador
    $router = new Router();

    // Adiciona a rota para a agregado
    $router->addRoute('agregado', function() {
        $controller = new AgregadoController();
        $controller->index();
    });

    // Adiciona a rota para a rota 'user' login
    $router->addRoute('user/login', function() {
        $controller = new UserController();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $controller->login(); // Processa o login (POST)
        } else {
            $controller->showLoginForm(); // Exibe o formulário (GET)
        }
    });

    // Obtém o parâmetro da URL (ex: ?url=home)
    $route = isset($_GET['url']) ? $_GET['url'] : 'agregado'; // Rota padrão é 'user/login'

    // Recupera parâmetros adicionais (se existirem)
    $params = array_diff_key($_GET, array('url' => '')); // Remove o 'url' da lista de parâmetros

    // Chama o roteador para processar a rota
    $router->dispatch($route, $params);
    ?>
</body>
</html>
