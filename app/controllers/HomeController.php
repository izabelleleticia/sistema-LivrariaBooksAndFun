<?php


class HomeController extends Controller{

    
    public function index(){
        $dados = array();
        $dados['titulo'] = 'Site | Livraria BooksAndFun';

        var_dump($dados);

        $this->carregarViews('home', $dados);
       
    }


}