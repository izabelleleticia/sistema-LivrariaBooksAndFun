<?php

class SobreController extends Controller
{
    public function index()
    {
        $dados = array();
        $dados['titulo'] = 'Sobre | Livraria BooksAndFun';

        var_dump($dados);
        

        $this->carregarViews('sobre', $dados);
    }
}