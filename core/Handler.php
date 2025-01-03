<?php
session_start();
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    require_once '../core/autoload.php';

    $class  = $_POST['class']  ?? null;
    $action = $_POST['action'] ?? null;
    $params = $_POST['params'] ?? [];

    try{
        if (!$class || !$action) {
            throw new Exception('Classe ou método não especificado.');
        }

        // Verifica se a classe existe
        if (!class_exists($class)) {
            throw new Exception("Classe {$class} não encontrada.");
        }

        $controller = new $class();

        if(!method_exists($controller, $action)){
            throw new Exception("Função {$action} não existe na classe {$controller}");
        }
        call_user_func_array([$controller, $action], $params);
    }catch(Exception $e){
        header('Content-Type: application/json');
        echo json_encode(['success'=>false, 'error'=>$e->getMessage()]);
    }
}
