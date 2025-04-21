<?php

class LivroController extends Controller
{

    private $livroModel;
    public function __construct()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        $this->livroModel = new Livro();
    }

    // Método para exibir todos os livros
    public function index()
    {
        $livroModel = new Livro();
        $dados = array();
        $dados['titulo_pagina'] = 'Livro | Livraria BooksAndFun';
        $dados['livros'] = $livroModel->getLivro(); // Método getLivro() para pegar todos os livros
        $this->carregarViews('livros/index', $dados); // Carregar a view
    }

    // Método para exibir detalhes de um livro
    public function detalhe($id)
    {
        $dados = array();
        $dados['titulo_pagina'] = 'Livro | Livraria BooksAndFun';

        $livroModel = new Livro();
        $livros = $livroModel->getLivroInfo($id); // Pega os dados do livro específico

        $dados['livros'] = $livros;
        $this->carregarViews('detalhe-livro', $dados); // Carregar a view com os detalhes
    }

    // Método para listar todos os livros
    public function listar()
    {
        $dados = array();
        $dados['conteudo'] = 'admin/livro/listar'; // Caminho para a view
        $livroModel = new Livro(); // Instancia o modelo de livro
        $dados['livro'] = $livroModel->getInformacoesLivros(); // Pega as informações dos livros
        $this->carregarViews('admin/index', $dados); // Carregar a view
    }

    // Método para editar um livro
    public function editar($id = null)
    {
        $dados = array();
        $livroModel = new Livro(); // Instancia o modelo Livro
        $dadosLivro = $livroModel->getLivroInfo($id); // Pega os dados do livro específico

        // Verifica se a requisição foi feita por POST (ao submeter o formulário)
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Pega os dados do formulário (corrigindo os campos para os corretos)
            $id_livros = filter_input(INPUT_POST, 'id_livros', FILTER_SANITIZE_SPECIAL_CHARS);
            $titulo_livros = filter_input(INPUT_POST, 'titulo_livros', FILTER_SANITIZE_SPECIAL_CHARS);
            $descricao_livro = filter_input(INPUT_POST, 'descricao_livro', FILTER_SANITIZE_SPECIAL_CHARS);
            $nome_autor = filter_input(INPUT_POST, 'nome_autor', FILTER_SANITIZE_SPECIAL_CHARS);
            $descricao_genero = filter_input(INPUT_POST, 'descricao_genero', FILTER_SANITIZE_SPECIAL_CHARS);
            $ano_publicacao = filter_input(INPUT_POST, 'ano_publicacao', FILTER_SANITIZE_NUMBER_INT);
            $preco = filter_input(INPUT_POST, 'preco', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
            $estoque = filter_input(INPUT_POST, 'estoque', FILTER_SANITIZE_NUMBER_INT);
            $nome_editora = filter_input(INPUT_POST, 'nome_editora', FILTER_SANITIZE_SPECIAL_CHARS);
            $nome_serie = filter_input(INPUT_POST, 'nome_editora', FILTER_SANITIZE_SPECIAL_CHARS);

            // Verifica se os dados obrigatórios estão preenchidos
            if ($titulo_livros && $descricao_genero) {

                $arquivo = $dadosLivro['imagem']; // Começa assumindo a imagem atual

                // Verifica se uma nova imagem foi enviada e faz o upload
                if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] === 0) {
                    $arquivo = $this->uploadFoto($_FILES['imagem'], $titulo_livros); // Função para fazer o upload da imagem
                }

                // Organiza os dados do livro
                $dadosLivro = array(
                    'id_livros' => $id_livros,
                    'titulo_livros' => $titulo_livros,
                    'descricao_livro' => $descricao_livro,
                    'nome_autor' => $nome_autor,
                    'descricao_genero' => $descricao_genero,
                    'ano_publicacao' => $ano_publicacao,
                    'preco' => $preco,
                    'estoque' => $estoque,
                    'nome_editora' => $nome_editora,
                    'nomeserie' => $nome_serie,
                    'imagem' => $arquivo
                );

                // Chama o método para editar o livro no banco de dados
                $idLivro = $livroModel->editarLivro($dadosLivro); // Corrigido para editarLivro()

                if ($idLivro) {
                    $_SESSION['mensagem'] = 'Livro editado com sucesso';
                    $_SESSION['tipo-msg'] = 'sucesso';
                    header('Location: http://localhost/sistema-LivrariaBooksAndFun/public/livro/listar');
                    exit;
                } else {
                    $dados['mensagem'] = 'Erro ao editar o livro - Ao enviar para a base de dados';
                    $dados['tipo-msg'] = 'erro';
                }

            } else {
                $dados['mensagem'] = 'Erro ao editar o livro - Informe todos os dados';
                $dados['tipo-msg'] = 'erro';
            }
        }

        $dados['dadosLivro'] = $dadosLivro; // Passa os dados do livro para a view

        if (!$dadosLivro) {
            header('Location: ' . BASE_URL . 'livro/listar');
            exit;
        }

        // Buscar as editoras
        $editoraModel = new Editora();
        $dados['editoras'] = $editoraModel->getEditora(); // Agora retorna todas as editoras

        $autorModel = new Autor();
        $dados['autores'] = $autorModel->getAutores();

        $generoModel = new Genero();
        $dados['generos'] = $generoModel->getGenero();

        $serieModel = new Series();
        $dados['series'] = $serieModel->getSerie();



        $dados['conteudo'] = 'admin/livro/editar'; // Define o conteúdo da view
        $this->carregarViews('admin/index', $dados); // Carrega a view


    }

    public function adicionar()
    {
        // Faz o upload da imagem e adiciona o caminho ao array $dados
        $imagemCaminho = null;
        if (!empty($_FILES['imagem']['name'])) {
            $imagemCaminho = $this->uploadFoto($_FILES['imagem'], 'livro_');
        }

        // Pega os dados do formulário
        $dados = array(
            'titulo_livros' => filter_input(INPUT_POST, 'titulo_livros', FILTER_SANITIZE_SPECIAL_CHARS),
            'descricao_livro' => filter_input(INPUT_POST, 'descricao_livro', FILTER_SANITIZE_SPECIAL_CHARS),
            'imagem' => $imagemCaminho,
            'id_autor' => filter_input(INPUT_POST, 'id_autor', FILTER_SANITIZE_NUMBER_INT),
            'descricao_genero' => filter_input(INPUT_POST, 'descricao_genero', FILTER_SANITIZE_SPECIAL_CHARS),
            'nome_autor' => filter_input(INPUT_POST, 'nome_autor', FILTER_SANITIZE_SPECIAL_CHARS),
            'ano_publicacao' => filter_input(INPUT_POST, 'ano_publicacao', FILTER_SANITIZE_NUMBER_INT),
            'preco' => filter_input(INPUT_POST, 'preco', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION),
            'estoque' => filter_input(INPUT_POST, 'estoque', FILTER_SANITIZE_NUMBER_INT),
            'nome_editora' => filter_input(INPUT_POST, 'nome_editora', FILTER_SANITIZE_SPECIAL_CHARS),
            'nome_serie' => filter_input(INPUT_POST, 'nome_serie', FILTER_SANITIZE_SPECIAL_CHARS),
            'id_serie' => filter_input(INPUT_POST, 'id_serie', FILTER_SANITIZE_NUMBER_INT)
        );

        $livroModel = new Livro();

        // Chama o método de adicionar no modelo
        if ($livroModel->adicionar($dados)) {
            $_SESSION['mensagem'] = 'Livro adicionado com sucesso';
            $_SESSION['tipo-msg'] = 'sucesso';
            header('Location: ' . BASE_URL . 'livro/listar');
            exit;
        } else {
            $_SESSION['mensagem'] = 'Erro ao adicionar o livro';
            $_SESSION['tipo-msg'] = 'erro';
        }

        // Buscar as editoras
        $editoraModel = new Editora();
        $dados['editoras'] = $editoraModel->getEditora(); // Agora retorna todas as editoras

        $autorModel = new Autor();
        $dados['autores'] = $autorModel->getAutores();

        $generoModel = new Genero();
        $dados['generos'] = $generoModel->getGenero();

        $serieModel = new Series();
        $dados['series'] = $serieModel->getSerie();

        // var_dump(value: $dados);

        $dados['conteudo'] = 'admin/livro/adicionar';
        $this->carregarViews('admin/index', $dados);
    }

    public function uploadFoto($file, $nome)
    {
        $dir = 'uploads/livros/';
        if (!file_exists($dir)) {
            mkdir($dir, 0755, true);
        }

        $ext = pathinfo($file['name'], PATHINFO_EXTENSION);

        // Remove espaços e caracteres especiais
        $nome = preg_replace('/[^a-zA-Z0-9-_]/', '_', $nome);

        $nome_foto = uniqid() . '_' . $nome . '.' . $ext;

        if (move_uploaded_file($file['tmp_name'], $dir . $nome_foto)) {
            return 'livros/' . $nome_foto;
        }

        return false;
    }


    public function desativar($id)
    {
        // Verifica se a requisição é POST
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);  // Método não permitido
            echo json_encode(['status' => 'erro', 'mensagem' => 'Método não permitido']);
            exit;
        }

        // Define o tipo de conteúdo da resposta
        header('Content-Type: application/json');

        // Chama o método do modelo para desativar o livro
        $resultado = $this->livroModel->desativarLivro($id);

        if ($resultado) {
            // Resposta de sucesso
            echo json_encode(['status' => 'sucesso', 'mensagem' => 'Livro desativado com sucesso']);
        } else {
            // Erro ao desativar
            http_response_code(500); // erro interno do servidor
            echo json_encode(['status' => 'erro', 'mensagem' => 'Erro ao desativar o livro']);
        }

        // Finaliza a execução para evitar retorno de dados adicionais
        exit;
    }

    public function desativarLivro($id)
    {
        // Atualiza o estoque para 0, indicando que o livro foi desativado
        $sql = "UPDATE tbl_livros SET estoque = 0 WHERE id_livros = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

}

