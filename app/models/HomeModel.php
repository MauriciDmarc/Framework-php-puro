<?php

class HomeModel {

    private $db;
    private $conn;

    public __construct(){
        $this->db   = new Database();
        $this->conn = $this->getConn();
    }

    public function getData() {
        // Aqui você pode conectar ao banco de dados ou retornar dados estáticos
        return ['message' => 'Sucesso'];
    }
}
