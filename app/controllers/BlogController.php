<?php
class BlogController extends Controller {

    public function index() {
        $dados = array();
        $dados['titulo'] = 'Blog | Livraria BooksAndFun';

        // Instanciando o modelo e buscando um autor aleatório com seus livros
        $blogModel = new Blog();
        $dados['autor'] = $blogModel->getAutorELivros(); // Retorna autor aleatório e seus livros
        
        // Carregando a view e passando os dados
        $this->carregarViews('blog', $dados);
    }
}
