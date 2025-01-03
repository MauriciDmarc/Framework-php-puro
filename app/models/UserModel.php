<?php
class UserModel {
    private $db;
    private $conn;

    //coloque aqui sua tabela de users
    private $table = 'exp_users';

    public function __construct(){
        $this->db   = new Database();
        $this->conn = $this->db->getConnection();
    }
    
    public function register($matricula, $senha, $nivel){
        $query = "SELECT * FROM ".$this->table." WHERE matricula = :matricula";
        $stmt  = $this->conn->prepare($query);
        $stmt->bindParam(':matricula', $matricula);
        $stmt->execute();
        
        if($stmt->rowCount() > 0){
            return false; //matricula ja existe
        }
        $hashed = password_hash($senha, PASSWORD_DEFAULT);
        try{
            echo $nivel;
            $query = "INSERT INTO ".$this->table." (matricula, senha, nivel) VALUES (:matricula, :senha, :nivel)";
            $stmt  = $this->conn->prepare($query);
            $stmt->bindParam(':matricula', $matricula);
            $stmt->bindParam(':senha', $hashed);
            $stmt->bindParam(':nivel', $nivel);
            $stmt->execute();

            return true;
        }catch(PDOException $e){
            echo "Erro: $e";
            return false;
        }
        
        
    }

    public function login($matricula, $senha){
        $query = "SELECT * FROM ".$this->table." WHERE matricula = :matricula";
        $stmt  = $this->conn->prepare($query);
        $stmt->bindParam(':matricula', $matricula);
        $stmt->execute();

        if($stmt->rowCount() == 0){
            return false; //usuario nao encontrado
        }

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if(password_verify($senha, $user['senha'])){
            session_start();
            $_SESSION['matricula'] = $user['matricula'];
            return true; //senha correta
        }

        return false; //senha incorreta
    }

    public function modifyPass($senha1, $senha2, $sessao){
        $query = "SELECT * FROM ".$this->table." WHERE matricula = :matricula";
        $stmt  = $this->conn->prepare($query);
        $stmt->bindParam(':matricula', $sessao);
        $stmt->execute(); 

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if(password_verify($senha1, $result['senha'])){
            $hashed = password_hash($senha2, PASSWORD_DEFAULT);
            
            $query = "UPDATE exp_users SET senha = :novasenha WHERE matricula = :matricula";
            $stmt  = $this->conn->prepare($query);
            $stmt->bindParam(':novasenha', $hashed);
            $stmt->bindParam(':matricula', $sessao);
            $stmt->execute(); 

            if ($stmt->rowCount() > 0) {
                return true;
            } else {
                return false;
            }

        }else{
            return false;
        }
    }
}
