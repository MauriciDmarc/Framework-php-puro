<php 

class Controller {

    //Método para renderizar a view
    public function render($view, $data = []){
        
        //Extrai dados para variáveis 
        extract($data);

        //inclui a view
        require_once "../app/views/{$view}.PHP";
    }
}