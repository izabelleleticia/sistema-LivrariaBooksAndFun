<?php


class VendaController extends Controller
{
    public function adicionar()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $dadosVenda = [
                'id_cliente' => $_POST['id_cliente'],
                'data_venda' => $_POST['data_venda'],
                'valor_total' => $_POST['valor_total'],
                'forma_pagamento' => $_POST['forma_pagamento']
            ];
    
            $vendaModel = new Venda();
    
            // Aqui já insere a venda e os itens
            $id_venda = $vendaModel->adicionarVendaComItens($dadosVenda, $_POST['itens_venda']);
    
            if ($id_venda) {
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
    
        $clientesModel = new Clientes();
        $livroModel = new Livro();
        $dados['clientes'] = $clientesModel->getClientes();
        $dados['livros'] = $livroModel->getLivro();
    
        $dados['conteudo'] = 'admin/venda/adicionar';
        $this->carregarViews('admin/index', $dados);
    }
    


    // Método para listar as vendas
    public function listar()
    {
        $vendaModel = new Venda(); // Instancia o model
    
        // Usa a instância correta para chamar o método
        $totalVendasMes = $vendaModel->contarVendasMesAtual();
        $vendas = $vendaModel->listarVendas();
    
        // Passa os dados para a view
        $dados['vendas'] = $vendas;
        var_dump($totalVendasMes);
        $dados['totalVendasMes'] = $totalVendasMes;
        $dados['titulo'] = "Lista de Vendas";
        $dados['conteudo'] = 'admin/venda/listar';
    
        $this->carregarViews('admin/index', $dados);
    }
    
//     public function itens_venda($id_venda)
// {
//     $vendaModel = new Venda();
    
//     // Pega os dados da venda (opcional, caso queira mostrar cabeçalho com cliente/data etc)
//     $dados['venda'] = $vendaModel->listarVendaPorId($id_venda); // você pode criar esse método se precisar

//     // Pega os itens da venda
//     $dados['itens'] = $vendaModel->listarItensVenda($id_venda);

//     $dados['titulo'] = "Itens da Venda";
//     $dados['conteudo'] = 'admin/venda/itens_venda/listar';

//     $this->carregarViews('admin/index', $dados);
// }
public function itens_venda()
{
    $vendaModel = new Venda();

    // Método do model que deve retornar todos os itens de vendas com cliente e livro
    $itensVenda = $vendaModel->listarTodosItensVendas(); 

    $dados['titulo'] = "Itens de Todas as Vendas";
    $dados['itensVenda'] = $itensVenda;
    $dados['conteudo'] = 'admin/venda/itens_venda/listar';

    $this->carregarViews('admin/index', $dados);
}


}
