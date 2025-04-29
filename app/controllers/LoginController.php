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
        // Verifica se a requisição é do tipo POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Captura as variáveis enviadas pelo formulário
            $email = trim($_POST['email'] ?? '');
            $senha = trim($_POST['senha'] ?? '');

            // Verifica se os campos não estão vazios
            if (!empty($email) && !empty($senha)) {
                // Instancia o model Login
                $loginModel = new Login();

                // Chama o método getLogin para buscar o usuário no banco
                $usuarios = $loginModel->getLogin($email, $senha); // Passando o e-mail para a consulta

                $usuarioEncontrado = null;

                // Verifica se algum usuário foi encontrado
                foreach ($usuarios as $usuario) {
                    if ($usuario['email_usuario'] === $email) {
                        $usuarioEncontrado = $usuario;
                        break;
                    }
                }

                // Se o usuário foi encontrado, verifica a senha
                if ($usuarioEncontrado) {
                    if (password_verify($senha, $usuarioEncontrado['senha_usuario'])) {
                        // Login bem-sucedido, armazena dados na sessão
                        $_SESSION['msg_successo'] = "Login realizado com sucesso!";
                        $_SESSION['usuario_id'] = $usuarioEncontrado['id_usuario']; // Exemplo, pode ser ajustado
                        header("Location: http://localhost/sistema-LivrariaBooksAndFun/public/admin"); // Redireciona para a página inicial
                        exit;
                    } else {
                        // Senha incorreta
                        $_SESSION['msg_erro'] = "Senha incorreta.";
                        header("Location: login.php");
                        exit;
                    }
                } else {
                    // E-mail não encontrado
                    $_SESSION['msg_erro'] = "E-mail não encontrado.";
                    header("Location: login.php");
                    exit;
                }
            } else {
                // Se os campos de e-mail ou senha estiverem vazios
                $_SESSION['msg_erro'] = "Por favor, preencha todos os campos.";
                header("Location: login.php");
                exit;
            }
        } else {
            // Se não for um POST, redireciona para o login
            header("Location: login.php");
            exit;
        }
    }
}
?>
