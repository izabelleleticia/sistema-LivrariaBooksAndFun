<?php


class VendaController extends Controller{
    public function adicionar()
    {
        // Verifica se a requisição foi feita via POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Recebe os dados do formulário
            $dados = [
                'nome_cliente' => $_POST['nome_cliente'],  // Nome do cliente
                'data_venda' => $_POST['data_venda'],      // Data da venda
                'valor_total' => $_POST['valor_total'],    // Valor total da venda
                'forma_pagamento' => $_POST['forma_pagamento'] // Forma de pagamento
            ];
            
            // Cria uma instância do modelo de venda
            $vendaModel = new Venda();
            
            // Chama o método de adicionar venda
            $resultado = $vendaModel->adicionarVenda($dados);
            
            // Verifica se a venda foi adicionada com sucesso
            if ($resultado === true) {
                $_SESSION['mensagem'] = "Venda adicionada com sucesso!";
                $_SESSION['tipo-msg'] = "sucesso";
                header('Location: ' . BASE_URL . 'venda/listar');
                exit;
            } else {
                $_SESSION['mensagem'] = "Erro ao adicionar venda: " . $resultado;
                $_SESSION['tipo-msg'] = "erro";
                header('Location: ' . BASE_URL . 'venda/adicionar');
                exit;
            }
        }
        
        // Carregar a view de adicionar venda
        $this->carregarViews('venda/adicionar');
    }

    // Método para listar as vendas
    public function listar()
    {
        $vendaModel = new Venda();
        $vendas = $vendaModel->listarVendas();

        // Passa as vendas para a view
        $dados['vendas'] = $vendas;
        $dados['titulo'] = "Lista de Vendas";
        $this->carregarViews('admin/index', $dados);
    }
}