<?php

class HomeController {

    public function index() {
        // Instancia o modelo
        $model = new HomeModel();

        // Obtém os dados do modelo
        $data = $model->getData();

        // Carrega a visão com os dados
        require_once '../app/views/home.php';
    }
}
