<?php

class HomeController extends Controller {

    public function index() {
        // Instancia o modelo
        $model = new HomeModel();

        // Obtém os dados do modelo
        $data = $model->getData();

        // Carrega a visão com os dados
        $this->render('home', $data);
    }
}
