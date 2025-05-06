<?php 
require_once __DIR__ . '/../Mail/src/PHPMailer.php';
require_once __DIR__ . '/../Mail/src/SMTP.php';
require_once __DIR__ . '/../Mail/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;



class EmailController extends Controller {

    public function enviarEmail($dados) {
        try {
            $enviar = new PHPMailer();
            $enviar->isSMTP();
            $enviar->SMTPDebug = 0;
            $enviar->Host = "smtp.hostinger.com";
            $enviar->Port = 465;
            $enviar->SMTPSecure = 'ssl';
            $enviar->SMTPAuth = true;
            $enviar->Username = "ti26@smpsistema.com.br";
            $enviar->Password = "Senac@ti26"; // Ideal: proteger essa senha com variável de ambiente
            $enviar->isHTML(true);

            $enviar->setFrom("ti26@smpsistema.com.br", $dados['nome']);
            $enviar->addAddress("honeymoonspam@gmail.com", "Contato BooksAndFun");
            $enviar->Subject = $dados['assunto'];
            $enviar->msgHTML("Nome: {$dados['nome']} <br>
                              E-mail: {$dados['email']} <br>
                              Telefone: {$dados['fone']} <br>
                              Mensagem: {$dados['mensagem']}");

            $enviar->AltBody = "Nome: {$dados['nome']}\n
                                E-mail: {$dados['email']}\n
                                Telefone: {$dados['fone']}\n
                                Mensagem: {$dados['mensagem']}";

            if (!$enviar->send()) {
                throw new Exception("Erro ao enviar: " . $enviar->ErrorInfo);
            }
            return true;

        } catch (Exception $e) {
            return false;
        }
    }

    public function enviarEmailResposta($dados) {
        try {
            $enviar = new PHPMailer();
            $enviar->isSMTP();
            $enviar->SMTPDebug = 0;
            $enviar->Host = "smtp.hostinger.com";
            $enviar->Port = 465;
            $enviar->SMTPSecure = 'ssl';
            $enviar->SMTPAuth = true;
            $enviar->Username = "ti26@smpsistema.com.br";
            $enviar->Password = "Senac@ti26";
            $enviar->isHTML(true);

            $enviar->setFrom("ti26@smpsistema.com.br", "Resposta BooksAndFun");
            $enviar->addAddress($dados['email'], $dados['nome']);
            $enviar->Subject = $dados['assunto'];
            $enviar->msgHTML("Olá {$dados['nome']}! <br>
                              Um momento, em breve retornaremos seu contato.<br>
                              Mensagem: {$dados['mensagem']}<br>
                              Em caso de dúvidas ligue para (11)99962-3300");

            $enviar->AltBody = "Olá, {$dados['nome']}!\n
                                Um momento, em breve retornaremos seu contato.\n
                                Mensagem: {$dados['mensagem']}\n
                                Em caso de dúvidas ligue para (11)99962-3300";

            $enviar->send();
            return true;

        } catch (Exception $e) {
            return false;
        }
    }
}

// 👇 Esta parte deve ficar **fora da classe**
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['email'])) {
    $dados = [
        'nome' => htmlspecialchars($_POST['nome']), 
        'email' => filter_var($_POST['email'], FILTER_SANITIZE_EMAIL),
        'fone' => htmlspecialchars($_POST['fone']),
        'mensagem' => htmlspecialchars($_POST['mensagem']),
        'assunto' => "CONTATO SITE - BOOKSANDFUN"
    ];

    $contatoModel = new Contato();
    $emailController = new EmailController();

    $contatoSalvo = $contatoModel->salvarContato($dados);

    if ($contatoSalvo) {
        $emailEnviado = $emailController->enviarEmail($dados);
        if ($emailEnviado) {
            $emailController->enviarEmailResposta($dados);
            header("Location: index.php?status=sucesso");
            exit;
        } else {
            header("Location: index.php?status=erro");
            exit;
        }
    } else {
        header("Location: index.php?status=erro_banco");
        exit;
    }
}
