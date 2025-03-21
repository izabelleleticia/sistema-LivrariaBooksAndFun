<?php


class ContatoController extends Controller
{


    public function index()
    {
        $dados = array();
        $dados['titulo'] = 'Contato | BooksAndFun';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nome = $_POST['nome'];
            $email = $_POST['email'];
            $assunto = $_POST['assunto'];
            $mensagem = $_POST['mensagem'];

            // Validação simples para garantir que os campos não estão vazios
            if (empty($nome) || empty($email) || empty($assunto) || empty($mensagem)) {
                $dados['erro'] = 'Por favor, preencha todos os campos.';
            } else {
                // Inclui o arquivo de funções de e-mail
                require_once 'config/email.php';

                // Define o destinatário e o corpo do e-mail
                $destinatario = 'destinatario@exemplo.com'; // Substitua pelo e-mail para onde as mensagens devem ser enviadas
                $assuntoEmail = "Mensagem de Contato: " . $assunto;
                $corpoEmail = "Nome: " . $nome . "\nEmail: " . $email . "\n\nMensagem:\n" . $mensagem;

                // Chama a função de envio de e-mail
                $emailEnviado = enviarEmail($destinatario, $assuntoEmail, $corpoEmail, $email);

                // Verifica se o e-mail foi enviado com sucesso
                if ($emailEnviado) {
                    $dados['sucesso'] = 'Mensagem enviada com sucesso!';
                } else {
                    $dados['erro'] = 'Erro ao enviar a mensagem. Tente novamente mais tarde.';
                }
            }
        }

        // Carrega a view com os dados de erro ou sucesso
        $this->carregarViews('contato', $dados);
    }
}


