<?php 

class Editora extends Model
{
    public function getEditora()
    {
        $sql = "SELECT nome_editora FROM tbl_editoras;";
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
