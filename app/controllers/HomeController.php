<?php


class HomeController extends Controller{

    
    public function index(){
        $dados = array();
        $dados['titulo'] = 'Site | Livraria BooksAndFun';
    
        $destaquesModel = new Destaques();
        $destaques = $destaquesModel->getDestaques();
        $dados['destaques'] = $destaques;
    
        $ficcaoModel = new Ficcao();
        $ficcao = $ficcaoModel->getFiccao(); 
        $dados['ficcao'] = $ficcao;

        $romanceModel = new Romance();
        $romance = $romanceModel->getRomance();
        $dados['romance'] = $romance;
    
        $this->carregarViews('home', $dados);
    }
    
}