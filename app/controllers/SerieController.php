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

public function adicionar()
{
    // Faz o upload da imagem e adiciona o caminho ao array $dados
    $imagemCaminho = null;
    if (!empty($_FILES['imagem']['name'])) {
        $imagemCaminho = $this->uploadFoto($_FILES['imagem'], 'series_'); // Altere o prefixo para 'series_'
    }

    // Pega os dados do formulário
    $dados = array(
        'nome_serie' => filter_input(INPUT_POST, 'nome_serie', FILTER_SANITIZE_SPECIAL_CHARS),
        'plataforma' => filter_input(INPUT_POST, 'plataforma', FILTER_SANITIZE_SPECIAL_CHARS),
        'ano_lancamento' => filter_input(INPUT_POST, 'ano_lancamento', FILTER_SANITIZE_NUMBER_INT),
        'genero' => filter_input(INPUT_POST, 'genero', FILTER_SANITIZE_SPECIAL_CHARS),
        'sinopse' => filter_input(INPUT_POST, 'sinopse', FILTER_SANITIZE_SPECIAL_CHARS),
        'imagem' => $imagemCaminho, // Caminho da imagem da série
    );

    // Verifica se o nome da série foi preenchido corretamente
    if (empty($dados['nome_serie'])) {
        $_SESSION['mensagem'] = 'O campo Nome da Série é obrigatório.';
        $_SESSION['tipo-msg'] = 'erro';
        $dados['conteudo'] = 'admin/serie/adicionar';
        $this->carregarViews('admin/index', $dados);
        return;
    }

    // Cria uma instância do modelo da série
    $serieModel = new Series();

    // Chama o método de adicionar no modelo
    if ($serieModel->AdicionarSerie($dados)) {
        $_SESSION['mensagem'] = 'Série adicionada com sucesso';
        $_SESSION['tipo-msg'] = 'sucesso';
        header('Location: ' . BASE_URL . 'serie/listar'); // Redireciona para a página de listagem de séries
        exit;
    } else {
        $_SESSION['mensagem'] = 'Erro ao adicionar a série';
        $_SESSION['tipo-msg'] = 'erro';
    }

    // Mantém os dados para debug, caso necessário
    var_dump($dados); // Para depuração

    // Define o conteúdo da página
    $dados['conteudo'] = 'admin/serie/adicionar';
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
}


