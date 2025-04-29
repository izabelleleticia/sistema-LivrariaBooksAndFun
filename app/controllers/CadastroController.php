<?php

class CadastroController extends Controller
{
    public function index()
    {
        $dados = array();
        $dados['titulo'] = 'Cadastro | Livraria BooksAndFun';
        $this->carregarViews('cadastro', $dados);
    }

    public function cadastrar()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nome = trim($_POST['nome'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $senha = trim($_POST['senha'] ?? '');

            // Verifica se os campos foram preenchidos
            if (!empty($nome) && !empty($email) && !empty($senha)) {

                // Carrega o model Cadastro
                $cadastroModel = new Cadastro(); // <- AQUI USAMOS O SEU MODEL CORRETO

                // Chama o método cadastrar
                $resultado = $cadastroModel->cadastrar($nome, $email, $senha);

                if ($resultado === true) {
                    $_SESSION['msg_successo'] = "Cadastro realizado com sucesso!";
                    header("Location: " . BASE_URL . "home");
                    exit;
                } else {
                    $_SESSION['msg_erro'] = $resultado;
                    header("Location: " . BASE_URL . "cadastro");
                    exit;
                }

            } else {
                $_SESSION['msg_erro'] = "Por favor, preencha todos os campos.";
                header("Location: " . BASE_URL . "cadastro");
                exit;
            }
        } else {
            header("Location: " . BASE_URL . "cadastro");
            exit;
        }
    }
 

    }
