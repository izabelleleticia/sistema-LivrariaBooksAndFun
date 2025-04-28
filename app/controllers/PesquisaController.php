<?php
// Controllers/PesquisaController.php

class PesquisaController extends Controller {

    public function index() {
        // Verifica se o parâmetro 'query' foi passado via GET
        if (isset($_GET['query']) && !empty($_GET['query'])) {
            $query = $_GET['query'];

            // Instancia o model para fazer a pesquisa no banco
            $livros = new Livro();

            // Chama o método de pesquisa passando a query
            $resultados = $livros->pesquisar($query);

            // Passa os resultados para a view
            $this->carregarViews('pesquisa', ['resultados' => $resultados]);
        } else {
            // Caso não haja consulta, redireciona para a página inicial ou uma página de erro
            $this->carregarViews('pesquisa', ['resultados' => []]);
        }
    }
}
