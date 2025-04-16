<?php

class Autor extends Model
{
    public function getAutores()
    {
        $sql = "select nome_autor from tbl_autores";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();  // Usando fetchAll para obter todos os registros
        if ($stmt->execute()) {
            echo "Livro adicionado com sucesso.";
        } else {
            // Verifique o erro de execução
            echo "Erro ao adicionar o livro: " . implode(", ", $stmt->errorInfo());


        }
    }
}