<?php


class VendaController extends Controller
{
    public function adicionar()
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Recebe os dados da venda
        $dadosVenda = [
            'id_cliente' => $_POST['id_cliente'],
            'data_venda' => $_POST['data_venda'],
            'valor_total' => $_POST['valor_total'],
            'forma_pagamento' => $_POST['forma_pagamento']
        ];

        // Cria a instância do modelo de vendas
        $vendaModel = new Venda();

        // Chama o método de adicionar a venda
        $id_venda = $vendaModel->adicionarVenda($dadosVenda); // Retorna o ID da venda inserida

        if ($id_venda) {
            // Agora, adiciona os itens da venda
            $itensVenda = $_POST['itens_venda']; // Assumindo que os itens são enviados como um array

            foreach ($itensVenda as $item) {
                $dadosItem = [
                    'id_venda' => $id_venda,
                    'id_produto' => $item['id_produto'],
                    'quantidade' => $item['quantidade'],
                    'preco_unitario' => $item['preco_unitario'],
                    'valor_total_item' => $item['quantidade'] * $item['preco_unitario']
                ];

                $vendaModel->adicionarItemVenda($dadosItem);
            }

            $_SESSION['mensagem'] = "Venda e itens adicionados com sucesso!";
            $_SESSION['tipo-msg'] = "sucesso";
            header('Location: ' . BASE_URL . 'venda/listar');
            exit;
        } else {
            $_SESSION['mensagem'] = "Erro ao adicionar venda!";
            $_SESSION['tipo-msg'] = "erro";
            header('Location: ' . BASE_URL . 'venda/adicionar');
            exit;
        }
    }

    // Carregar clientes e produtos
    $clientesModel = new Clientes();
    $livroModel = new Livro();
    $dados['clientes'] = $clientesModel->getClientes();
    $dados['livros'] = $livroModel->getLivro();

    // Carregar a view
    $dados['conteudo'] = 'admin/venda/adicionar';
    $this->carregarViews('admin/index', $dados);
}


    // Método para listar as vendas
    public function listar()
    {
        $vendaModel = new Venda();
        $vendas = $vendaModel->listarVendas();

        // Passa as vendas para a view
        $dados['vendas'] = $vendas;
        $dados['titulo'] = "Lista de Vendas";
        $dados['conteudo'] = 'admin/venda/listar'; // Caminho para a view

        $this->carregarViews('admin/index', $dados);
    }
}
