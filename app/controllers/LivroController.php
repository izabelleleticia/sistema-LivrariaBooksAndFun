<?php

class LivroController extends Controller
{

    public function index()
    {
        
        $livroModel = new Livro();
        $dados = array();
        $dados['titulo_pagina'] = 'Livro | Livraria BooksAndFun';
        $dados['livros'] = $livroModel->getLivro(); 
        $this->carregarViews('livro', $dados);
        var_dump($dados);


    }
}
