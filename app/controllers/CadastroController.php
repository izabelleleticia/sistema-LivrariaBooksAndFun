<?php


class CadastroController extends Controller{

    
    public function index(){
        $dados = array();
        $dados['titulo'] = 'Cadastro | Livraria BooksAndFun';
        $autorModel = new Autores();
        $autorModel->
        $this->carregarViews('cadastro', $dados);
       
    }
    



}