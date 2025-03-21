<?php
require_once "Model.php"; // Importa a conexão com o banco

class Cadastro
{
    private $pdo;

    public function __construct()
    {
        $conexao = new Model(); // Instancia a conexão
        $this->pdo = $conexao->getConexao();
    }
    public function cadastrar($nome, $email, $senha)
    {
        try {
            $sql = "INSERT INTO tbl_usuarios (nome_usuario, email_usuario, senha_usuario) VALUES (:nome, :email, :senha)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(":nome", $nome);
            $stmt->bindParam(":email", $email);

            $senhaHash = password_hash($senha, PASSWORD_DEFAULT); // Corrigindo o erro
            $stmt->bindParam(":senha", $senhaHash); // Agora a variável pode ser passada

            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            return "Erro ao cadastrar: " . $e->getMessage();
        }
    }

    public function logar($email, $senha)
    {
        try {
            $sql = "SELECT * FROM tbl_usuarios WHERE email_usuario = :email";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(":email", $email);
            $stmt->execute();

            // Verifique se encontrou o usuário com o e-mail informado
            if ($stmt->rowCount() > 0) {
                $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

                // Verifique se a senha fornecida é correta
                if (password_verify($senha, $usuario['senha_usuario'])) {
                    // Redireciona para a página inicial após o login bem-sucedido
                    header("Location: home.php");
                    exit(); // Importante para garantir que o script seja interrompido após o redirecionamento
                } else {
                    return "Senha incorreta.";
                }
            } else {
                return "E-mail não encontrado.";
            }
        } catch (PDOException $e) {
            return "Erro ao tentar realizar o login: " . $e->getMessage();
        }
    }
}
