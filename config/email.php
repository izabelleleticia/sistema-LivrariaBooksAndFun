<?php
//reconher os arquivos do phpmailer

require_once("phpmailer/src/PHPMailer.php");
require_once("phpmailer/src/SMTP.php");

function enviarEmail($dados){
    try{
        $enviar = new PHPMailer\PHPMailer\PHPMailer();
        $enviar->isSMTP();
        $enviar->SMTPDebug = 0;
        $enviar->Host = "smtp.hostinger.com";
        $enviar->Port = 465;
        $enviar->SMTPSecure = 'ssl';
        $enviar->SMTPAuth = true;
        $enviar->Username = "ti26@smpsistema.com.br";
        $enviar->Password = "Senac@ti26";
        $enviar->isHTML(true);

        //Configurar o e-mail principal
        $enviar->setFrom("ti26@smpsistema.com.br", $dados['nome']);
        $enviar->addAddress("honeymoonspam@gmail.com", "Contato BooksAndFun");
        $enviar->Subject = $dados['assunto'];
        $enviar->msgHTML("Nome: {$dados['nome']} <br>
        E-mail: {$dados['email']} <br>
        Telefone: {$dados['fone']} <br>
        Mensagem: {$dados['mensagem']} <br>");

        $enviar->AltBody = "Nome: {$dados['nome']} \n
        E-mail: {$dados['email']} \n
        Telefone: {$dados['fone']} \n
        Mensagem: {$dados['mensagem']}";



        if (!$enviar->send()){
            throw new Exception("Erro ao enviar o E-mail:".$enviar->ErrorInfo);
        }

    }
    catch(Exception $e){
        return false;

    }
    return true;

}
//Email de resposta
function enviarEmailResposta($dados){
    try{
        $enviar = new PHPMailer\PHPMailer\PHPMailer();
        $enviar->isSMTP();
        $enviar->SMTPDebug = 0;
        $enviar->Host = "smtp.hostinger.com";
        $enviar->Port = 465;
        $enviar->SMTPSecure = 'ssl';
        $enviar->SMTPAuth = true;
        $enviar->Username = "ti26@smpsistema.com.br";
        $enviar->Password = "Senac@ti26";
        $enviar->isHTML(true);

        //Configuração do email de resposta
        $enviar->setFrom("ti26@smpsistema.com.br", "Resposta BooksAndFun");
        $enviar->addAddress($dados['email'], $dados['nome']);
        $enviar->Subject = $dados['assunto'];
        $enviar->msgHTML("Olá {$dados['nome']}! <br>
                        Um momento, em breve retornaremos seu contato.
                        Mensagem: {$dados['mensagem']}
                        Em caso de dúvidas ligue para (11)99962-3300");

        $enviar->AltBody = "Olá, {$dados['nome']}! \n
        Um momento, em breve retornaremos seu contato. \n
        Mensagem: {$dados['mensagem']} \n
        Em caso de dúvidas ligue para (11)99962-3300";



        $enviar->send();

    }
    catch(Exception $e){
        return false;

    }
    return true;

}
//Salvar no banco de dados
function salvarContato($dados)
{
    try {
        // Abrir a conexão com banco de dados
        $pdo = new PDO("mysql:host=smpsistema.com.br;dbname=u283879542_booksandfun","u283879542_booksandfun","@Booksandfun01");
        // $pdo = new PDO("mysql:host=localhost;dbname=db_booksandfun", "root", "");

        $pdo->exec("SET time_zone = '-03:00'"); 
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Inserir as informações no banco
        $inserir = "INSERT INTO tbl_contato (nome_contato, tel_contato, email_contato, mensagem_contato, status_contato)
                    VALUES (:nome, :tel, :email, :mensagem, 'Aguardando')";
        $stmt = $pdo->prepare($inserir);

        // Vincular os parâmetros
        $stmt->bindParam(':nome', $dados['nome']);
        $stmt->bindParam(':tel', $dados['fone']);
        $stmt->bindParam(':email', $dados['email']);
        $stmt->bindParam(':mensagem', $dados['mensagem']);

        // Executar a inserção
        $stmt->execute();
        return true;
    } catch (PDOException $e) {
        error_log("Erro ao salvar no banco de dados: " . $e->getMessage());
        return false;
    }
}


//Estrutura Lógica
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['email'])) {
    $dados = [
        'nome' => htmlspecialchars($_POST['nome']), 
        'email' => filter_var($_POST['email'], FILTER_SANITIZE_EMAIL),
        'fone' => htmlspecialchars($_POST['fone']),
        'mensagem' => htmlspecialchars($_POST['mensagem']),
        'assunto' => "CONTATO SITE - BOOKSANDFUN"
    ];

    $contatoSalvo = salvarContato($dados);

    
    if ($contatoSalvo){
        $emailEnviado = enviarEmail($dados);
        if($emailEnviado){
        enviarEmailResposta($dados);
        header("Location: index.php?status=sucesso");
        exit;
        
       } else  {
        header("Location: index.php?status=erro");
        exit;
       }
    } else {
        header("Location: index.php?status=erro_banco");

}


}

?>