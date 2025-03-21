<?php


class BlogController extends Controller{

    
    public function index(){
        $dados = array();
        $dados['titulo'] = 'Blog | Livraria BooksAndFun';

        $this->carregarViews('blog', $dados);
       
    }


}