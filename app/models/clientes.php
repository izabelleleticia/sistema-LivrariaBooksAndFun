<?php class Clientes extends Model
{
    public function getClientes()
    {
        $sql = "SELECT * FROM tbl_clientes WHERE status != 'inativo';";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function desativarCliente($id)
    {
        $sql = "UPDATE tbl_clientes SET status = 'inativo' WHERE id_cliente = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }

    public function getClienteById($id)
    {
        $sql = "SELECT * FROM tbl_clientes WHERE id_cliente = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch();
    }
    public function editarCliente($dados)
{
    $sql = "UPDATE tbl_clientes 
            SET nome_cliente = :nome, 
                email_cliente = :email, 
                telefone_cliente = :telefone, 
                endereco_cliente = :endereco, 
                cidade_cliente = :cidade, 
                estado_cliente = :estado 
            WHERE id_cliente = :id";

    $stmt = $this->db->prepare($sql);

    $stmt->bindParam(':nome', $dados['nome_cliente']);
    $stmt->bindParam(':email', $dados['email_cliente']);
    $stmt->bindParam(':telefone', $dados['telefone_cliente']);
    $stmt->bindParam(':endereco', $dados['endereco_cliente']);
    $stmt->bindParam(':cidade', $dados['cidade_cliente']);
    $stmt->bindParam(':estado', $dados['estado_cliente']);
    $stmt->bindParam(':id', $dados['id_cliente'], PDO::PARAM_INT);

    return $stmt->execute();
}
   // Método para adicionar cliente
   public function adicionarCliente($dados)
   {
       // Extrair os dados do array de entrada
       $nome_cliente = $dados['nome_cliente'];
       $email_cliente = $dados['email_cliente'];
       $telefone_cliente = $dados['telefone_cliente'];
       $endereco_cliente = $dados['endereco_cliente'];
       $cidade_cliente = $dados['cidade_cliente'];
       $estado_cliente = $dados['estado_cliente'];

       // Verificar se os dados obrigatórios existem
       if (empty($nome_cliente) || empty($email_cliente)) {
           return false; // Se faltarem dados obrigatórios, retorna falso
       }

       // Inserir os dados na tabela de clientes
       $stmt = $this->db->prepare("
           INSERT INTO tbl_clientes (
               nome_cliente, email_cliente, telefone_cliente, endereco_cliente, cidade_cliente, estado_cliente
           ) VALUES (
               :nome_cliente, :email_cliente, :telefone_cliente, :endereco_cliente, :cidade_cliente, :estado_cliente
           )
       ");

       // Bind dos parâmetros
       $stmt->bindParam(':nome_cliente', $nome_cliente);
       $stmt->bindParam(':email_cliente', $email_cliente);
       $stmt->bindParam(':telefone_cliente', $telefone_cliente);
       $stmt->bindParam(':endereco_cliente', $endereco_cliente);
       $stmt->bindParam(':cidade_cliente', $cidade_cliente);
       $stmt->bindParam(':estado_cliente', $estado_cliente);

       return $stmt->execute(); // true se sucesso, false se erro
   }



    

}
