<?php

class Contato extends Model
{
    //Salvar no banco de dados
    public function salvarContato($dados)
    {
        try {
            $sql = "INSERT INTO tbl_contato (nome_contato, tel_contato, email_contato, mensagem_contato, status_contato)
        VALUES (:nome, :tel, :email, :mensagem, 'Aguardando')";
              $stmt = $this->db->prepare($sql);

            // Vincular os parâmetros
            $stmt->bindParam(':nome', $dados['nome']);
            $stmt->bindParam(':tel', $dados['fone']);
            $stmt->bindParam(':email', $dados['email']);
            $stmt->bindParam(':mensagem', $dados['mensagem']);

            // Executar a inserção
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            error_log("Erro ao salvar no banco de dados: " . $e->getMessage());
            return false;

        }
    }
}