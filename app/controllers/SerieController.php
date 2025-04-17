<?php


class SerieController extends Controller
{

    // Método para listar todos os livros
    public function listar()
    {
        $dados = array();
        $dados['conteudo'] = 'admin/serie/listar'; // Caminho para a view
        $serieModel = new Series(); // Instancia o modelo de série
        $dados['serie'] = $serieModel->getSeries(); // Pega as informações dos livros
        $this->carregarViews('admin/index', $dados); // Carregar a view
    }

    // Método para editar um livro
    public function editar($id = null)
{
    // Inicializando a variável $dados corretamente
    $dados = array();

    $serieModel = new Series();
    $dadosSerie = $serieModel->getSeriePorId($id);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nome_serie = filter_input(INPUT_POST, 'nome_serie', FILTER_SANITIZE_SPECIAL_CHARS);
        $plataforma = filter_input(INPUT_POST, 'plataforma', FILTER_SANITIZE_SPECIAL_CHARS);
        $ano_lancamento = filter_input(INPUT_POST, 'ano_lancamento', FILTER_SANITIZE_SPECIAL_CHARS);
        $genero = filter_input(INPUT_POST, 'genero', FILTER_SANITIZE_SPECIAL_CHARS);
        $sinopse = filter_input(INPUT_POST, 'sinopse', FILTER_SANITIZE_SPECIAL_CHARS);

        if ($nome_serie && $plataforma && $ano_lancamento && $genero && $sinopse) {
            // Se houver uma imagem, fazer upload
            $arquivo = $dadosSerie['imagem'];
            if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] === 0) {
                $arquivo = $this->uploadFoto($_FILES['imagem'], $nome_serie);
            }

            // Atualizando os dados da série
            $dadosSerie = array(
                'nome_serie' => $nome_serie,
                'plataforma' => $plataforma,
                'ano_lancamento' => $ano_lancamento,
                'genero' => $genero,
                'sinopse' => $sinopse,
                'imagem' => $arquivo
            );

            // Atualizando a série no banco de dados
            $idSerie = $serieModel->editarSerie($id, $dadosSerie);

            if ($idSerie) {
                $_SESSION['mensagem'] = 'Série editada com sucesso';
                $_SESSION['tipo-msg'] = 'sucesso';
                header('Location: http://localhost/sistema-LivrariaBooksAndFun/public/serie/listar');
                exit;
            } else {
                $dados['mensagem'] = 'Erro ao editar a série - Ao enviar para a base de dados';
                $dados['tipo-msg'] = 'erro';
            }
        } else {
            $dados['mensagem'] = 'Erro ao editar a série - Informe todos os dados';
            $dados['tipo-msg'] = 'erro';
        }
    }

    if (!$dadosSerie) {
        header('Location: ' . BASE_URL . 'serie/listar');
        exit;
    }

    $streamingModel = new Streaming();
    $dados['plataforma'] = $streamingModel->getStreaming();

    $generoModel = new Genero();
    $dados['generos'] = $generoModel->getGeneroSerie();

    $dados['dadosSerie'] = $dadosSerie;
    $dados['conteudo'] = 'admin/serie/editar';

    $this->carregarViews('admin/index', $dados);
}

    // public function adicionar()
    // {
    //     // Faz o upload da imagem e adiciona o caminho ao array $dados
    //     $imagemCaminho = null;
    //     if (!empty($_FILES['imagem']['name'])) {
    //         $imagemCaminho = $this->uploadFoto($_FILES['imagem'], 'livro_');
    //     }

    //     // Pega os dados do formulário
    //     $dados = array(
    //         'titulo_livros' => filter_input(INPUT_POST, 'titulo_livros', FILTER_SANITIZE_SPECIAL_CHARS),
    //         'imagem' => $imagemCaminho,
    //         'id_autor' => filter_input(INPUT_POST, 'id_autor', FILTER_SANITIZE_NUMBER_INT),
    //         'descricao_genero' => filter_input(INPUT_POST, 'descricao_genero', FILTER_SANITIZE_SPECIAL_CHARS),
    //         'nome_autor' => filter_input(INPUT_POST, 'nome_autor', FILTER_SANITIZE_SPECIAL_CHARS),
    //         'ano_publicacao' => filter_input(INPUT_POST, 'ano_publicacao', FILTER_SANITIZE_NUMBER_INT),
    //         'preco' => filter_input(INPUT_POST, 'preco', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION),
    //         'estoque' => filter_input(INPUT_POST, 'estoque', FILTER_SANITIZE_NUMBER_INT),
    //         'nome_editora' => filter_input(INPUT_POST, 'nome_editora', FILTER_SANITIZE_SPECIAL_CHARS),
    //         'nome_serie' => filter_input(INPUT_POST, 'nome_serie', FILTER_SANITIZE_SPECIAL_CHARS),
    //         'id_serie' => filter_input(INPUT_POST, 'id_serie', FILTER_SANITIZE_NUMBER_INT)
    //     );

    //     $livroModel = new Livro();

    //     // Chama o método de adicionar no modelo
    //     if ($livroModel->adicionar($dados)) {
    //         $_SESSION['mensagem'] = 'Livro adicionado com sucesso';
    //         $_SESSION['tipo-msg'] = 'sucesso';
    //         header('Location: ' . BASE_URL . 'livro/listar');
    //         exit;
    //     } else {
    //         $_SESSION['mensagem'] = 'Erro ao adicionar o livro';
    //         $_SESSION['tipo-msg'] = 'erro';
    //     }

    //     // Buscar as editoras
    //     $editoraModel = new Editora();
    //     $dados['editoras'] = $editoraModel->getEditora(); // Agora retorna todas as editoras

    //     $autorModel = new Autor();
    //     $dados['autores'] = $autorModel->getAutores();

    //     $generoModel = new Genero();
    //     $dados['generos'] = $generoModel->getGenero();

    //     $serieModel = new Series();
    //     $dados['series'] = $serieModel->getSerie();

    //     var_dump($dados);

    //     $dados['conteudo'] = 'admin/livro/adicionar';
    //     $this->carregarViews('admin/index', $dados);


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
}


