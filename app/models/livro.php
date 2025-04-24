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
            l.descricao_livro, 
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
        LEFT JOIN tbl_editoras AS e ON l.id_editora = e.id_editora 
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
        // Extrair os dados do array
        $id_livros = $dados['id_livros'];
        $titulo_livros = $dados['titulo_livros'];
        $descricao_livro = $dados['descricao_livro'];
        $imagem = $dados['imagem'];
        $nome_autor = $dados['nome_autor'];
        $descricao_genero = $dados['descricao_genero'];
        $ano_publicacao = $dados['ano_publicacao'];
        $preco = $dados['preco'];
        $estoque = $dados['estoque'];
        $nome_editora = $dados['nome_editora'];
        $nome_serie = $dados['nome_serie'];

        // Buscar o ID da Série
        $stmt = $this->db->prepare("SELECT id_serie FROM tbl_series WHERE nome_serie = :nome_serie");
        $stmt->bindParam(':nome_serie', $nome_serie);
        $stmt->execute();
        $id_serie = $stmt->fetchColumn();

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

        // Verifica se os dados obrigatórios existem
        if (!$id_genero || !$id_editora || !$id_autor) {
            return false;
        }
        // Montar SQL
        $sql = "UPDATE tbl_livros SET
        titulo_livros = :titulo_livros,
        descricao_livro = :descricao_livro,
        id_autor = :id_autor,
        id_genero = :id_genero,
        ano_publicacao = :ano_publicacao,
        preco = :preco,
        estoque = :estoque,
        id_editora = :id_editora,
        id_serie = :id_serie";

        // Atualiza a imagem se ela estiver presente
        if (!empty($imagem)) {
            $sql .= ", imagem = :imagem";
        }

        $sql .= " WHERE id_livros = :id_livros";

        $stmt = $this->db->prepare($sql);

        // Bind comum
        $stmt->bindParam(':titulo_livros', $titulo_livros);
        $stmt->bindParam(':descricao_livro', $descricao_livro);
        $stmt->bindParam(':id_autor', $id_autor);
        $stmt->bindParam(':id_genero', $id_genero);
        $stmt->bindParam(':ano_publicacao', $ano_publicacao);
        $stmt->bindParam(':preco', $preco);
        $stmt->bindParam(':estoque', $estoque);
        $stmt->bindParam(':id_editora', $id_editora);
        $stmt->bindParam(':id_serie', $id_serie);
        $stmt->bindParam(':id_livros', $id_livros);

        if (!empty($imagem)) {
            $stmt->bindParam(':imagem', $imagem);
        }

        return $stmt->execute();
    }

    // Método para adicionar um novo livro
    public function adicionar($dados)
    {
        // Extrair os dados do array de entrada
        $titulo_livros = $dados['titulo_livros'];
        $descricao_livro = $dados['descricao_livro'];
        $imagem = $dados['imagem'];
        $nome_autor = $dados['nome_autor'];
        $descricao_genero = $dados['descricao_genero'];
        $ano_publicacao = $dados['ano_publicacao'];
        $preco = $dados['preco'];
        $estoque = $dados['estoque'];
        $nome_editora = $dados['nome_editora'];
        $nome_serie = $dados['nome_serie'];

        // Buscar/criar o ID da Série
        $stmt = $this->db->prepare("SELECT id_serie FROM tbl_series WHERE nome_serie = :nome_serie");
        $stmt->bindParam(':nome_serie', $nome_serie);
        $stmt->execute();
        $id_serie = $stmt->fetchColumn();

        if (!$id_serie && !empty($nome_serie)) {
            // Se não existe, insere uma nova série
            $stmt = $this->db->prepare("INSERT INTO tbl_series (nome_serie) VALUES (:nome_serie)");
            $stmt->bindParam(':nome_serie', $nome_serie);
            $stmt->execute();
            $id_serie = $this->db->lastInsertId();
        }

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

        // Verificar se os dados obrigatórios existem
        if (!$id_genero || !$id_editora || !$id_autor) {
            return false;
        }

        // Inserir os dados na tabela livros
        $stmt = $this->db->prepare("
        INSERT INTO tbl_livros (
            titulo_livros, descricao_livro, imagem, id_autor, id_genero,
            ano_publicacao, preco, estoque, id_editora, id_serie
        ) VALUES (
            :titulo_livros, :descricao_livro, :imagem, :id_autor, :id_genero,
            :ano_publicacao, :preco, :estoque, :id_editora, :id_serie
        )
    ");

        // Bind dos parâmetros
        $stmt->bindParam(':titulo_livros', $titulo_livros);
        $stmt->bindParam(':descricao_livro', $descricao_livro);
        $stmt->bindParam(':imagem', $imagem);
        $stmt->bindParam(':id_autor', $id_autor);
        $stmt->bindParam(':id_genero', $id_genero);
        $stmt->bindParam(':ano_publicacao', $ano_publicacao);
        $stmt->bindParam(':preco', $preco);
        $stmt->bindParam(':estoque', $estoque);
        $stmt->bindParam(':id_editora', $id_editora);
        $stmt->bindParam(':id_serie', $id_serie); // <- agora com id_serie

        return $stmt->execute(); // true se sucesso, false se erro
    }

    public function desativarLivro($id)
    {
        $sql = "UPDATE tbl_livros SET estoque = 0 WHERE id_livros = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
    public function incrementarCliques($id) {
        $sql = "UPDATE tbl_livros SET cliques = cliques + 1 WHERE id_livros = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
    }
    
    public function getLivrosMaisClicados($limite = 5) {
        $sql = "SELECT * FROM tbl_livros ORDER BY cliques DESC LIMIT :limite";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':limite', $limite, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    
}
