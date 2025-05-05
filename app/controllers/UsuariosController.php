<?php

class UsuariosController extends Controller
{
    // LISTAR USUÁRIOS
    public function listar()
    {
        $usuarioModel = new Usuario();
        $dados['usuarios'] = $usuarioModel->getUsuarios();
        $dados['titulo'] = "Lista de Usuários";
        $dados['conteudo'] = 'admin/usuario/listar';
        $this->carregarViews('admin/index', $dados);
    }

    // ADICIONAR USUÁRIO
    public function adicionar()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Faz o upload da imagem e adiciona o caminho ao array $dados
            $imagemCaminho = null;
            if (!empty($_FILES['imagem']['name'])) {
                $imagemCaminho = $this->uploadFoto($_FILES['imagem'], 'usuario_');
            
            }
            // Pega os dados do formulário
            $dadosUsuario = array(
                'nome_usuario' => filter_input(INPUT_POST, 'nome_usuario', FILTER_SANITIZE_SPECIAL_CHARS),
                'email_usuario' => filter_input(INPUT_POST, 'email_usuario', FILTER_SANITIZE_EMAIL),
                'senha_usuario' => password_hash(filter_input(INPUT_POST, 'senha_usuario', FILTER_SANITIZE_STRING), PASSWORD_DEFAULT),
                'imagem' => $imagemCaminho,
            );
    
            // Validação simples para evitar campos nulos
            if (empty($dadosUsuario['nome_usuario']) || empty($dadosUsuario['email_usuario']) || empty($dadosUsuario['senha_usuario'])) {
                $_SESSION['mensagem'] = 'Por favor, preencha todos os campos obrigatórios.';
                $_SESSION['tipo-msg'] = 'erro';
            } else {
                // Insere no banco
                $usuarioModel = new Usuario();
                if ($usuarioModel->adicionar($dadosUsuario)) {
                    $_SESSION['mensagem'] = 'Usuário adicionado com sucesso!';
                    $_SESSION['tipo-msg'] = 'sucesso';
                    header('Location: ' . BASE_URL . 'usuarios/listar');
                    exit;
                } else {
                    $_SESSION['mensagem'] = 'Erro ao adicionar o usuário.';
                    $_SESSION['tipo-msg'] = 'erro';
                }
            }
        }
    
        // Carrega a view (independente se for GET ou POST)
        $dados['titulo'] = 'Adicionar Usuário';
        $dados['conteudo'] = 'admin/usuario/adicionar';
        $this->carregarViews('admin/index', $dados);
    }
    
    // public function uploadFoto($file, $nome)
    // {
    //     $dirRelativo = 'usuarios/';
    //     $dirAbsoluto = 'C:/xampp/htdocs/sistema-LivrariaBooksAndFun/public/uploads/' . $dirRelativo;
    
    //     if (!file_exists($dirAbsoluto)) {
    //         mkdir($dirAbsoluto, 0755, true);
    //     }
    
    //     $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
    //     $nome = preg_replace('/[^a-zA-Z0-9-_]/', '_', $nome);
    //     $nome_foto = uniqid() . '_' . $nome . '.' . $ext;
    
    //     if (move_uploaded_file($file['tmp_name'], $dirAbsoluto . $nome_foto)) {
    //         // Salva no banco apenas o caminho relativo (para exibição na web)
    //         return $dirRelativo . $nome_foto;
    //     }
    
    //     return false;
    // }
     public function uploadFoto($file, $nome)
    {
        // Caminho absoluto para a pasta onde as imagens serão salvas
        $dir = 'C:/xampp/htdocs/sistema-LivrariaBooksAndFun/public/uploads/usuarios/';
    
        // Verifica se o diretório existe, caso contrário, cria o diretório
        if (!file_exists($dir)) {
            mkdir($dir, 0755, true);
        }
    
        // Pega a extensão do arquivo
        $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
    
        // Remove espaços e caracteres especiais do nome
        $nome = preg_replace('/[^a-zA-Z0-9-_]/', '_', $nome);
    
        // Gera um nome único para o arquivo
        $nome_foto = uniqid() . '_' . $nome . '.' . $ext;
    
        // Move o arquivo para o diretório desejado
        if (move_uploaded_file($file['tmp_name'], $dir . $nome_foto)) {
            // Retorna o caminho relativo da imagem, para salvar no banco
            return 'uploads/usuarios/' . $nome_foto;
        }
    
        // Caso não consiga mover o arquivo, retorna false
        return false;
    }
    
    
    
    
    // EDITAR USUÁRIO
    public function editar($id)
    {
        $usuarioModel = new Usuario();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $dados = [
                'id' => $id,
                'nome' => $_POST['nome'],
                'email' => $_POST['email']
            ];

            // Só atualiza senha se tiver preenchido
            if (!empty($_POST['senha'])) {
                $dados['senha'] = password_hash($_POST['senha'], PASSWORD_DEFAULT);
            }

            $usuarioModel->editarUsuario($dados);

            $_SESSION['mensagem'] = "Usuário atualizado com sucesso!";
            $_SESSION['tipo-msg'] = "sucesso";
            header('Location: ' . BASE_URL . 'usuarios/listar');
            exit;
        }

        $dados['usuario'] = $usuarioModel->getUsuarioPorId($id);
        $dados['titulo'] = "Editar Usuário";
        $dados['conteudo'] = 'admin/usuario/editar';
        $this->carregarViews('admin/index', $dados);
    }

    // EXCLUIR USUÁRIO
    public function excluir($id)
    {
        $usuarioModel = new Usuario();
        $usuarioModel->excluirUsuario($id);

        $_SESSION['mensagem'] = "Usuário excluído com sucesso!";
        $_SESSION['tipo-msg'] = "sucesso";
        header('Location: ' . BASE_URL . 'usuarios/listar');
        exit;
    }
}
