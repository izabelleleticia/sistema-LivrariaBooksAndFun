<?php

class ClienteController extends Controller
{
    // Método para listar clientes
    public function listar()
    {
        $dados = array();
        $dados['titulo'] = 'Clientes | BooksAndFun';
        $dados['conteudo'] = 'admin/clientes/listar';
        $ClientesModel = new Clientes();
        $dados['clientes'] = $ClientesModel->getClientes();
        $this->carregarViews('admin/index', $dados);
    }

    // Método para desativar cliente
    public function desativar($id)
    {
        $ClientesModel = new Clientes();
        if ($ClientesModel->desativarCliente($id)) {
            echo json_encode(['mensagem' => 'Cliente desativado com sucesso.']);
        } else {
            http_response_code(500);
            echo json_encode(['mensagem' => 'Erro ao desativar cliente.']);
        }
    }

    // Método para editar cliente
    public function editar($id = null)
    {
        $dados = array();
        $ClientesModel = new Clientes();
        $dadosCliente = $ClientesModel->getClienteById($id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id_cliente = filter_input(INPUT_POST, 'id_cliente', FILTER_SANITIZE_SPECIAL_CHARS);
            $nome_cliente = filter_input(INPUT_POST, 'nome_cliente', FILTER_SANITIZE_SPECIAL_CHARS);
            $email_cliente = filter_input(INPUT_POST, 'email_cliente', FILTER_SANITIZE_EMAIL);
            $telefone_cliente = filter_input(INPUT_POST, 'telefone_cliente', FILTER_SANITIZE_SPECIAL_CHARS);
            $endereco_cliente = filter_input(INPUT_POST, 'endereco_cliente', FILTER_SANITIZE_SPECIAL_CHARS);
            $cidade_cliente = filter_input(INPUT_POST, 'cidade_cliente', FILTER_SANITIZE_SPECIAL_CHARS);
            $estado_cliente = filter_input(INPUT_POST, 'estado_cliente', FILTER_SANITIZE_SPECIAL_CHARS);

            if ($nome_cliente && $email_cliente) {
                $dadosCliente = array(
                    'id_cliente' => $id_cliente,
                    'nome_cliente' => $nome_cliente,
                    'email_cliente' => $email_cliente,
                    'telefone_cliente' => $telefone_cliente,
                    'endereco_cliente' => $endereco_cliente,
                    'cidade_cliente' => $cidade_cliente,
                    'estado_cliente' => $estado_cliente
                );

                $clienteEditado = $ClientesModel->editarCliente($dadosCliente);

                if ($clienteEditado) {
                    $_SESSION['mensagem'] = 'Cliente editado com sucesso';
                    $_SESSION['tipo-msg'] = 'sucesso';
                    header('Location: ' . BASE_URL . 'cliente/listar');
                    exit;
                } else {
                    $dados['mensagem'] = 'Erro ao editar o cliente';
                    $dados['tipo-msg'] = 'erro';
                }
            } else {
                $dados['mensagem'] = 'Informe todos os dados obrigatórios';
                $dados['tipo-msg'] = 'erro';
            }
        }

        $dados['cliente'] = $dadosCliente;

        if (!$dadosCliente) {
            header('Location: ' . BASE_URL . 'cliente/listar');
            exit;
        }

        $dados['titulo'] = 'Editar Cliente | BooksAndFun';
        $dados['conteudo'] = 'admin/clientes/editar';
        $this->carregarViews('admin/index', $dados);
    }

    // Método para adicionar cliente
    public function adicionar()
    {
        $dados = array();
        $dados['titulo'] = 'Adicionar Cliente | BooksAndFun';
        $dados['conteudo'] = 'admin/clientes/adicionar';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Pega os dados do formulário com filtro
            $nome_cliente = filter_input(INPUT_POST, 'nome_cliente', FILTER_SANITIZE_SPECIAL_CHARS);
            $email_cliente = filter_input(INPUT_POST, 'email_cliente', FILTER_SANITIZE_EMAIL);
            $telefone_cliente = filter_input(INPUT_POST, 'telefone_cliente', FILTER_SANITIZE_SPECIAL_CHARS);
            $endereco_cliente = filter_input(INPUT_POST, 'endereco_cliente', FILTER_SANITIZE_SPECIAL_CHARS);
            $cidade_cliente = filter_input(INPUT_POST, 'cidade_cliente', FILTER_SANITIZE_SPECIAL_CHARS);
            $estado_cliente = filter_input(INPUT_POST, 'estado_cliente', FILTER_SANITIZE_SPECIAL_CHARS);

            // Verifica se os dados obrigatórios estão preenchidos
            if ($nome_cliente && $email_cliente) {
                // Organiza os dados do cliente
                $dadosCliente = array(
                    'nome_cliente' => $nome_cliente,
                    'email_cliente' => $email_cliente,
                    'telefone_cliente' => $telefone_cliente,
                    'endereco_cliente' => $endereco_cliente,
                    'cidade_cliente' => $cidade_cliente,
                    'estado_cliente' => $estado_cliente
                );

                // Instancia o modelo Cliente
                $ClientesModel = new Clientes();

                // Chama o método para adicionar o cliente no banco de dados
                $clienteAdicionado = $ClientesModel->adicionarCliente($dadosCliente);

                if ($clienteAdicionado) {
                    $_SESSION['mensagem'] = 'Cliente adicionado com sucesso';
                    $_SESSION['tipo-msg'] = 'sucesso';
                    header('Location: ' . BASE_URL . 'cliente/listar');
                    exit;
                } else {
                    $dados['mensagem'] = 'Erro ao adicionar o cliente - Ao enviar para a base de dados';
                    $dados['tipo-msg'] = 'erro';
                }
            } else {
                $dados['mensagem'] = 'Erro ao adicionar o cliente - Informe todos os dados obrigatórios';
                $dados['tipo-msg'] = 'erro';
            }
        }

        $this->carregarViews('admin/index', $dados);
    }
}
