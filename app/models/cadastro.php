<?php 

class Cadastro
{
    private $pdo;

    public function __construct()
    {
        $model = new Model(); // Instancia a classe Model
        $this->pdo = $model->getConexao(); // Pega a conexão da instância de Model
    }

    public function cadastrar($nome, $email, $senha) {
        try {
            $sql = "INSERT INTO tbl_usuarios (nome_usuario, email_usuario, senha_usuario) 
                    VALUES (:nome, :email, :senha)";
            $stmt = $this->pdo->prepare($sql);
    
            $stmt->bindParam(":nome", $nome);
            $stmt->bindParam(":email", $email);
    
            // Criptografar a senha
            $senhaHash = password_hash($senha, PASSWORD_DEFAULT);
            $stmt->bindValue(":senha", $senhaHash); // Corrigido aqui
    
            $stmt->execute();
    
            return true;
        } catch (PDOException $e) {
            return "Erro ao cadastrar: " . $e->getMessage();
        }}
      
    }
    
