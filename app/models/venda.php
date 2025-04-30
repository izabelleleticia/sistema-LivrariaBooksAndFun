<?php class Venda extends Model
{
    // Método para adicionar uma venda
    public function adicionarVenda($dados)
    {
        try {
            // Preparando a query para inserir os dados na tabela 'tbl_vendas'
            $sql = "INSERT INTO tbl_vendas (id_cliente, data_venda, valor_total, forma_pagamento) 
                    VALUES (:id_cliente, :data_venda, :valor_total, :forma_pagamento)";
            
            $stmt = $this->db->prepare($sql);
            
            // Bind dos parâmetros com os dados recebidos
            $stmt->bindParam(':id_cliente', $dados['id_cliente'], PDO::PARAM_INT);
            $stmt->bindParam(':data_venda', $dados['data_venda'], PDO::PARAM_STR);
            $stmt->bindParam(':valor_total', $dados['valor_total'], PDO::PARAM_STR);
            $stmt->bindParam(':forma_pagamento', $dados['forma_pagamento'], PDO::PARAM_STR);
            
            // Executando a query
            if ($stmt->execute()) {
                return $this->db->lastInsertId(); // Retorna o ID da última venda inserida
            } else {
                return false;
            }
        } catch (PDOException $e) {
            return "Erro ao adicionar venda: " . $e->getMessage();
        }
    }
     // Método para adicionar um item de venda
     public function adicionarItemVenda($dados)
     {
         try {
             // Preparando a query para inserir os itens na tabela 'tbl_itens_vendas'
             $sql = "INSERT INTO tbl_itens_vendas (id_venda, id_produto, quantidade, preco_unitario, valor_total_item) 
                     VALUES (:id_venda, :id_produto, :quantidade, :preco_unitario, :valor_total_item)";
             
             $stmt = $this->db->prepare($sql);
             
             // Bind dos parâmetros com os dados recebidos
             $stmt->bindParam(':id_venda', $dados['id_venda'], PDO::PARAM_INT);
             $stmt->bindParam(':id_produto', $dados['id_produto'], PDO::PARAM_INT);
             $stmt->bindParam(':quantidade', $dados['quantidade'], PDO::PARAM_INT);
             $stmt->bindParam(':preco_unitario', $dados['preco_unitario'], PDO::PARAM_STR);
             $stmt->bindParam(':valor_total_item', $dados['valor_total_item'], PDO::PARAM_STR);
             
             // Executando a query
             return $stmt->execute();
         } catch (PDOException $e) {
             return "Erro ao adicionar item de venda: " . $e->getMessage();
         }
     }
    

    // Método para buscar o ID do cliente pelo nome
    public function buscarIdClientePorNome($nome_cliente)
    {
        $sql = "SELECT id_cliente FROM tbl_clientes WHERE nome_cliente = :nome_cliente LIMIT 1";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':nome_cliente', $nome_cliente, PDO::PARAM_STR);
        $stmt->execute();

        $cliente = $stmt->fetch(PDO::FETCH_ASSOC);
        return $cliente ? $cliente['id_cliente'] : null;
    }
    public function listarVendas()
    {
        // Query para pegar todas as vendas
        $sql = "SELECT v.id_venda, v.data_venda, v.valor_total, v.forma_pagamento, c.nome_cliente 
                FROM tbl_vendas v
                JOIN tbl_clientes c ON v.id_cliente = c.id_cliente
                ORDER BY v.data_venda DESC";
        
        // Preparar e executar a consulta
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        
        // Retorna todas as vendas
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
