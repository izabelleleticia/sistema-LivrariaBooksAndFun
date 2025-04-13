<?php 

class LivroController extends Controller
{
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
            $descricao_genero = filter_input(INPUT_POST, 'descricao_genero', FILTER_SANITIZE_SPECIAL_CHARS);
            $ano_publicacao = filter_input(INPUT_POST, 'ano_publicacao', FILTER_SANITIZE_NUMBER_INT);
            $preco = filter_input(INPUT_POST, 'preco', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
            $estoque = filter_input(INPUT_POST, 'estoque', FILTER_SANITIZE_NUMBER_INT);
            $nome_editora = filter_input(INPUT_POST, 'nome_editora', FILTER_SANITIZE_SPECIAL_CHARS);

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
                    'descricao_genero' => $descricao_genero,
                    'ano_publicacao' => $ano_publicacao,
                    'preco' => $preco,
                    'estoque' => $estoque,
                    'nome_editora' => $nome_editora,
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
        

        $dados['conteudo'] = 'admin/livro/editar'; // Caminho para a view de edição

        $this->carregarViews('admin/index', $dados); // Carregar a view de edição
    }
}
