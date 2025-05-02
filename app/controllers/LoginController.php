<?php

class LoginController extends Controller
{
    public function index()
    {
        // Aqui você pode preparar a página de login com as variáveis necessárias
        $dados = array();
        $dados['titulo'] = 'Login | Livraria BooksAndFun';
        $this->carregarViews('login', $dados); // Certifique-se de ter uma view 'login.php'
    }

    public function logar()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = trim($_POST['email'] ?? '');
            $senha = trim($_POST['senha'] ?? '');
    
            if (!empty($email) && !empty($senha)) {
                $loginModel = new Login();
                $usuario = $loginModel->getLogin($email); // Apenas o e-mail
    
                if ($usuario && password_verify($senha, $usuario['senha_usuario'])) {
                    // Login bem-sucedido
                    $_SESSION['msg_successo'] = "Login realizado com sucesso!";
                    $_SESSION['usuario_email'] = $usuario['email_usuario'];
                    header("Location: http://localhost/sistema-LivrariaBooksAndFun/public/admin");
                    exit;
                } else {
                    // E-mail não encontrado ou senha incorreta
                    $_SESSION['msg_erro'] = "E-mail ou senha inválidos.";
                    header("Location: login.php");
                    exit;
                }
            } else {
                $_SESSION['msg_erro'] = "Por favor, preencha todos os campos.";
                header("Location: login.php");
                exit;
            }
        } else {
            header("Location: login.php");
            exit;
        }
    }
    
}
?>
