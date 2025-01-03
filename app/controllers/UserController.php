<?php

class UserController extends Controller{
    private $userModel;

    public function __construct(){
        $this->userModel = new UserModel();
    }
    public function showRegisterForm() {
        $this->render('register');
    }

    // Função para exibir o formulário de login
    public function showLoginForm() {
        session_unset();
        $this->render('login');
    }

    public function register(){
        if($_SERVER['REQUEST_METHOD'] === "POST"){
            $matricula = $_POST['matricula'];
            $senha     = $_POST['senha'];
            $nivel     = $_POST['nivel'];
            
            if($this->userModel->register($matricula,$senha, $nivel)){
                header("Location: ?url=user/login");
                exit();
            }else{
                echo "Registro falhou!";
            }
        }
    }

    public function login(){
        if($_SERVER['REQUEST_METHOD'] === "POST"){

            $matricula = $_POST['matricula'];
            $senha     = $_POST['senha'];

            if($this->userModel->login($matricula, $senha)){
                header("Location: ?url=home");
                exit();
            }else{
                echo "<script>
                alert('Login Falhou! Verifique suas credenciais');
                window.location.href='?url=user/login'
                </script>";
                exit();
            }
        }
    }

    public function modifyPass(){
        $params = $_POST['params'];
        $senha1 = $params[0];
        $senha2 = $params[1];
        
        $sessao = $_SESSION['matricula'];


        $response = $this->userModel->modifyPass($senha1, $senha2, $sessao);

        header('Content-Type: application/json');
        if($response){
            echo json_encode(['success' => true, 'msg' => 'Senha atualizada!']);
        }else{
            echo json_encode(['success' => false, 'msg' => 'Erro! Senha atual não confere: '.$senha1]);
        }
        exit();
        
        
}

    public function logout(){
        session_unset();
        session_destroy();
        header("Location: ?url=user/login");
        exit();
    }
}
