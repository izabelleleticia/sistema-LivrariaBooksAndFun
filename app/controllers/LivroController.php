<?php

class LivroController extends Controller
{

    public function index()
    {
        
        $livroModel = new Livro();
        $dados = array();
        $dados['titulo_pagina'] = 'Livro | Livraria BooksAndFun';
        $dados['livros'] = $livroModel->getLivro(); 
       

       
        var_dump($dados['livros']);

    }

    public function detalhe($id){

      
        $dados = array();
        $dados['titulo_pagina'] = 'Livro | Livraria BooksAndFun';

        $livroModel = new Livro();
        $livros = $livroModel->getLivroInfo($id);

        $dados['livros'] = $livros;
        $this->carregarViews('detalhe-livro', $dados);


    }

    

}
