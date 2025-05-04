<?php

class AutorController extends Controller
{
    // Método para listar autores
    public function listar()
    {
        $dados = array();
        $dados['titulo'] = 'Autores | BooksAndFun';
        $dados['conteudo'] = 'admin/autores/listar';
        $AutoresModel = new Autores();  // Modelo de Autores
        $dados['autores'] = $AutoresModel->getAutores();  // Pega todos os autores
        $this->carregarViews('admin/index', $dados);
        var_dump($dados['autores']);
    }

    public function desativar($id)
{
    $autorModel = new Autores();

    if ($autorModel->desativarAutor($id)) {
        $_SESSION['mensagem'] = 'Autor desativado com sucesso.';
        $_SESSION['tipo-msg'] = 'sucesso';
    } else {
        $_SESSION['mensagem'] = 'Erro ao desativar o autor.';
        $_SESSION['tipo-msg'] = 'erro';
    }

    header('Location: ' . BASE_URL . 'autor/listar');
    exit;
}


    public function editar($id)
    {
        $dados = array();
        
        // Instancia o modelo de autores
        $AutoresModel = new Autores();
        
        // Pega os dados do autor
        $dados['autor'] = $AutoresModel->getAutorById($id);
        
        // Adiciona a foto atual no array de dados
        $dados['foto_atual'] = $dados['autor']['imagem'];
    
        // Verifica se a requisição foi feita por POST (ao submeter o formulário)
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Obtém os dados do formulário
            $nome_autor = filter_input(INPUT_POST, 'nome_autor', FILTER_SANITIZE_SPECIAL_CHARS);
            $nacionalidade_autor = filter_input(INPUT_POST, 'nacionalidade_autor', FILTER_SANITIZE_SPECIAL_CHARS);
            $biografia = filter_input(INPUT_POST, 'biografia', FILTER_SANITIZE_SPECIAL_CHARS);

            
            // Inicializa o valor da imagem com a imagem atual do autor
            $arquivo = $dados['foto_atual']; // Se não houver alteração, mantém a imagem atual
            
            if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] === 0) {
                // Caso uma nova imagem seja carregada, faz o upload da nova imagem
                $arquivo = $this->uploadFoto($_FILES['imagem'], $nome_autor); 
            }
    
            // Organiza os dados para atualização
            $dadosAutor = array(
                'nome_autor' => $nome_autor,
                'nacionalidade_autor' => $nacionalidade_autor,
                'biografia' => $biografia,
                'imagem' => $arquivo
            );
    
            // Chama o método de editar passando o ID e os dados
            if ($AutoresModel->editarAutor($id, $dadosAutor)) {
                $_SESSION['mensagem'] = 'Autor editado com sucesso';
                $_SESSION['tipo-msg'] = 'sucesso';
                header('Location: ' . BASE_URL . 'autor/listar');
                exit;
            } else {
                $dados['mensagem'] = 'Erro ao editar autor';
                $dados['tipo-msg'] = 'erro';
            }
        }
    
        // Passa os dados para a view
        $dados['titulo'] = 'Editar Autor | BooksAndFun';
        $dados['conteudo'] = 'admin/autores/editar';
        $this->carregarViews('admin/index', $dados);
    }
    
public function uploadFoto($file, $nome)
{
    $dir = 'uploads/autores/';
    if (!file_exists($dir)) {
        mkdir($dir, 0755, true);
    }

    // Valida a extensão do arquivo
    $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
    $valid_extensions = ['jpg', 'jpeg', 'png'];

    if (!in_array(strtolower($ext), $valid_extensions)) {
        return false; // Retorna false caso o arquivo não seja uma imagem válida
    }

    // Remove espaços e caracteres especiais
    $nome = preg_replace('/[^a-zA-Z0-9-_]/', '_', $nome);

    $nome_foto = uniqid() . '_' . $nome . '.' . $ext;

    if (move_uploaded_file($file['tmp_name'], $dir . $nome_foto)) {
        return 'autores/' . $nome_foto;
    }

    return false;
}

    public function adicionar()
{
    $dados = array();
    // Faz o upload da imagem e adiciona o caminho ao array $dados
   
        

    // Verifica se a requisição foi feita por POST (ao submeter o formulário)
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Pega os dados do formulário com filtro
        $nome_autor = filter_input(INPUT_POST, 'nome_autor', FILTER_SANITIZE_SPECIAL_CHARS);
        $nacionalidade_autor = filter_input(INPUT_POST, 'nacionalidade_autor', FILTER_SANITIZE_SPECIAL_CHARS);
        $biografia = filter_input(INPUT_POST, 'biografia', FILTER_SANITIZE_SPECIAL_CHARS);

        $imagemCaminho = null;
        if (!empty($_FILES['imagem']['name'])) {
            $imagemCaminho = $this->uploadFoto($_FILES['imagem'], $nome_autor);
            
         
        }
        // Verifica se os dados obrigatórios estão preenchidos
        if ($nome_autor) {
            // Organiza os dados do autor
            $dadosAutor = array(
                'nome_autor' => $nome_autor,
                'imagem' => $imagemCaminho,
                'nacionalidade_autor' => $nacionalidade_autor,
                'biografia' => $biografia,
            );

            $AutoresModel = new Autores();

            // Chama o método para adicionar o autor
            if ($AutoresModel->adicionarAutor($dadosAutor)) {
                $_SESSION['mensagem'] = 'Autor adicionado com sucesso';
                $_SESSION['tipo-msg'] = 'sucesso';
                header('Location: ' . BASE_URL . 'autor/listar');
                exit;
            } else {
                $dados['mensagem'] = 'Erro ao adicionar autor';
                $dados['tipo-msg'] = 'erro';
            }
        } else {
            $dados['mensagem'] = 'Erro ao adicionar autor - Informe todos os dados obrigatórios';
            $dados['tipo-msg'] = 'erro';
        }
    }

    // Passa os dados para a view
    $dados['titulo'] = 'Adicionar Autor | BooksAndFun';
    $dados['conteudo'] = 'admin/autores/adicionar';
    $this->carregarViews('admin/index', $dados);
}

}
