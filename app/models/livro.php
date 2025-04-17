<?php
//O modelo contém a lógica da aplicação, como regras de negócio, persistência com o banco de dados e classes de entidade
class Livro extends Model
{

    public function getLivro()
    {
        $sql = "SELECT * FROM tbl_livros where estoque <> 0 order by titulo_livros";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getLivroInfo($id)
    {
        $sql = "SELECT 
            l.id_livros, 
            l.titulo_livros, 
            l.imagem, 
            g.descricao_genero, 
            l.ano_publicacao, 
            l.preco, 
            l.estoque, 
            a.nome_autor, 
            e.nome_editora, 
            s.nome_serie
        FROM tbl_livros AS l 
        INNER JOIN tbl_generos AS g ON l.id_genero = g.id_genero 
        INNER JOIN tbl_editoras AS e ON l.id_editora = e.id_editora 
        LEFT JOIN tbl_autores AS a ON l.id_autor = a.id_autor 
        LEFT JOIN tbl_series AS s ON l.id_serie = s.id_serie
        WHERE l.id_livros = :id";

        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function getInformacoesLivros()
    {
        $sql = "SELECT l.id_livros, l.titulo_livros, l.imagem, g.descricao_genero, l.ano_publicacao, l.preco, l.estoque, e.nome_editora FROM tbl_livros AS l INNER JOIN tbl_generos AS g ON l.id_genero = g.id_genero INNER JOIN tbl_editoras AS e ON l.id_editora = e.id_editora where estoque <> 0 order by titulo_livros";
        // Prepara a consulta SQL
        $stmt = $this->db->prepare($sql);

        // Executa a consulta
        $stmt->execute();

        // Retorna todos os resultados encontrados (fetchAll) como um array associativo
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function editarLivro($dados)
    {
            $sql = "UPDATE tbl_livros  
        INNER JOIN tbl_editoras ON tbl_livros.id_editora = tbl_editoras.id_editora
    INNER JOIN tbl_generos ON tbl_livros.id_genero = tbl_generos.id_genero
    SET
                tbl_livros.titulo_livros = :titulo_livros,
                tbl_generos.descricao_genero = :descricao_genero,
                tbl_livros.ano_publicacao = :ano_publicacao,
                tbl_livros.preco = :preco,
                tbl_livros.estoque = :estoque,
                tbl_editoras.nome_editora = :nome_editora";


        // Verifica se a foto foi enviada para ser atualizada
        if (!empty($dados['imagem'])) {
            $sql .= ", imagem = :imagem";  // Adiciona a coluna foto_servico no SQL
        }

        // Adiciona a cláusula WHERE
        $sql .= " WHERE id_livros = :id";

        // Prepara a consulta
        $stmt = $this->db->prepare($sql);

        // Faz o binding dos parâmetros
        $stmt->bindValue(':id', (int) $dados['id_livros'], PDO::PARAM_INT);
        $stmt->bindValue(':titulo_livros', $dados['titulo_livros']);
        $stmt->bindValue(':descricao_genero', $dados['descricao_genero']);
        $stmt->bindValue(':ano_publicacao', $dados['ano_publicacao']);
        $stmt->bindValue(':preco', $dados['preco']);
        $stmt->bindValue(':estoque', $dados['estoque']);
        $stmt->bindValue(':nome_editora', $dados['nome_editora']);


        // Se a foto não estiver vazia, faz o binding do valor
        if (!empty($dados['imagem'])) {
            $stmt->bindValue(':imagem', $dados['imagem']);
        }

        // Executa a consulta e retorna o resultado
        return $stmt->execute();
    }
    // Método para adicionar um novo livro
    public function adicionar($dados)
    {

        // Extrair os dados do array de entrada
        $titulo_livros = $dados['titulo_livros'];
        $imagem = $dados['imagem'];
        $nome_autor = $dados['nome_autor'];
        $descricao_genero = $dados['descricao_genero'];
        $ano_publicacao = $dados['ano_publicacao'];
        $preco = $dados['preco'];
        $estoque = $dados['estoque'];
        $nome_editora = $dados['nome_editora'];
        // $id_serie = $dados['id_serie'];

        // Buscar o ID do Autor
        $stmt = $this->db->prepare("SELECT id_autor FROM tbl_autores WHERE nome_autor = :nome_autor");
        $stmt->bindParam(':nome_autor', $nome_autor);
        $stmt->execute();
        $id_autor = $stmt->fetchColumn();

        // Buscar o ID do Gênero
        $stmt = $this->db->prepare("SELECT id_genero FROM tbl_generos WHERE descricao_genero = :descricao_genero");
        $stmt->bindParam(':descricao_genero', $descricao_genero);
        $stmt->execute();
        $id_genero = $stmt->fetchColumn();

        // Buscar o ID da Editora
        $stmt = $this->db->prepare("SELECT id_editora FROM tbl_editoras WHERE nome_editora = :nome_editora");
        $stmt->bindParam(':nome_editora', $nome_editora);
        $stmt->execute();
        $id_editora = $stmt->fetchColumn();

        // Verificar se o Gênero e a Editora existem
        if (!$id_genero || !$id_editora || !$id_autor)  {
            return false; // Ou você pode retornar uma mensagem de erro
        }

        // Inserir os dados na tabela livros
        $stmt = $this->db->prepare("
            INSERT INTO tbl_livros (titulo_livros, imagem, id_autor, id_genero, ano_publicacao, preco, estoque, id_editora)
            VALUES (:titulo_livros, :imagem, :id_autor, :id_genero, :ano_publicacao, :preco, :estoque, :id_editora)
        ");

        // Fazer o bind dos parâmetros
        $stmt->bindParam(':titulo_livros', $titulo_livros);
        $stmt->bindParam(':imagem', $imagem);
        $stmt->bindParam(':id_autor', $id_autor);
        $stmt->bindParam(':id_genero', $id_genero);
        $stmt->bindParam(':ano_publicacao', $ano_publicacao);
        $stmt->bindParam(':preco', $preco);
        $stmt->bindParam(':estoque', $estoque);
        $stmt->bindParam(':id_editora', $id_editora);
        // $stmt->bindParam(':id_serie', $id_serie);

        // Executar a consulta
        if ($stmt->execute()) {
            return true; // Retorna verdadeiro se a inserção for bem-sucedida
        }

        return false; // Retorna falso em caso de erro
    }
    public function desativarLivro($id)
    {
        $sql = "UPDATE tbl_livros SET estoque = 0 WHERE id_livros = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}





