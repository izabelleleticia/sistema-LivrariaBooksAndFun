<?php

class Autores extends Model
{
    // Método para listar todos os autores
    public function getAutores()
    {
        $sql = "SELECT * FROM tbl_autores";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $autores = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        var_dump($autores);  // Verifique a saída para ver os dados completos
        return $autores;
    }
    

    // Método para desativar um autor (marcar como inativo)
    public function desativarAutor($id)
    {
        $sql = "UPDATE tbl_autores SET status = 'inativo' WHERE id_autor = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }

    // Método para buscar um autor por ID
    public function getAutorById($id)
    {
        $sql = "SELECT * FROM tbl_autores WHERE id_autor = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch();
    }

    // Método para editar um autor
    public function editarAutor($id, $dados)
    {
        // Verifica se uma nova imagem foi enviada e, caso contrário, mantém o valor atual da imagem
        $imagem = isset($dados['imagem']) && !empty($dados['imagem']) ? $dados['imagem'] : $dados['foto_atual'];
    
        // Definindo a consulta SQL para atualizar o autor
        $sql = "UPDATE tbl_autores 
                SET nome_autor = :nome_autor, 
                    nacionalidade_autor = :nacionalidade_autor,
                    imagem = :imagem
                WHERE id_autor = :id";
    
        // Preparando a consulta
        $stmt = $this->db->prepare($sql);
    
        // Vinculando os parâmetros com os dados recebidos
        $stmt->bindParam(':nome_autor', $dados['nome_autor']);
        $stmt->bindParam(':nacionalidade_autor', $dados['nacionalidade_autor']);
        $stmt->bindParam(':imagem', $imagem);
    
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    
        // Executa a consulta e retorna o resultado
        return $stmt->execute();
    }
    

    

    // Método para adicionar um novo autor
    public function adicionarAutor($dados)
    {
        // Extrair os dados do array de entrada
        $nome_autor = $dados['nome_autor'];
        $nacionalidade_autor = $dados['nacionalidade_autor'];

        // Verificar se os dados obrigatórios existem
        if (empty($nome_autor)) {
            return false; // Se faltar o nome do autor, retorna falso
        }

        // Inserir os dados na tabela de autores
        $stmt = $this->db->prepare("
            INSERT INTO tbl_autores (nome_autor, nacionalidade_autor)
            VALUES (:nome_autor, :nacionalidade_autor)
        ");

        // Bind dos parâmetros
        $stmt->bindParam(':nome_autor', $nome_autor);
        $stmt->bindParam(':nacionalidade_autor', $nacionalidade_autor);

        return $stmt->execute(); // true se sucesso, false se erro
    }
}
