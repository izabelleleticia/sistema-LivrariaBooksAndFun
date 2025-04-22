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

        // 1. Todas as séries
        $dados['series'] = $seriesModel->getSeries();
        
        // 2. Série com informações da plataforma (ex: ID 1)
        $dados['serie'] = $seriesModel->getSerieComStreamingPorId(1);
        
        // 3. Série aleatória para a home
        $dados['seriesHome'] = $seriesModel->getSeriesHome();
        
        // 4. Livros da série aleatória (pega o ID da que veio em 'seriesHome')
        $id_serieHome = $dados['seriesHome']['id_serie'];
        $dados['livrosDaSerie'] = $seriesModel->getLivroSerie($id_serieHome);
        
        // Debug temporário (você pode remover isso depois):
        // var_dump($dados['seriesHome']);
        


        $this->carregarViews('home', $dados);
    }

}