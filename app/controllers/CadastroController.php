<?php


class CadastroController extends Controller{

    
    public function index(){
        $dados = array();
        $dados['titulo'] = 'Cadastro | Livraria BooksAndFun';

        var_dump($dados);

        $this->carregarViews('cadastro', $dados);
       
    }
    



}