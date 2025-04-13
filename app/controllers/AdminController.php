<?php

class AdminController extends Controller
{


    public function index()
    {
        $dados = array();
        $dados['titulo'] = 'Dashboard | BooksAndFun';

        $this->carregarViews('admin/index', $dados);

    }


    
   

}