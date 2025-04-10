<?php


class HomeController extends Controller
{


    public function index()
    {
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


        $seriesModel = new Series();

        // Busca todas as séries
        $series = $seriesModel->getSeries();
        $dados['series'] = $series;

       
        $serie = $seriesModel->getSerieComStreamingPorId(1);
        $dados['serie'] = $serie;

        $serie = $seriesModel->getLivroSerie();
        $dados['livroSerie'] = $serie;

    // var_dump($serie);

        // Teste: exibe a estrutura do array
        // var_dump($dados['serie'])


        $this->carregarViews('home', $dados);
    }

}