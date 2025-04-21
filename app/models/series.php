<?php
class Series extends Model
{
    public function getSeries()
    {
        $sql = "SELECT id_serie, nome_serie, imagem, plataforma, genero, sinopse from tbl_series";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getSeriesHome()
    {
            $sql = "SELECT 
        s.id_serie, 
        s.nome_serie, 
        s.imagem AS imagem_serie, 
        s.genero, 
        s.sinopse, 
        p.nome_streaming, 
        p.logo_streaming, 
        p.site_streaming,
        l.titulo_livros, 
        l.imagem AS imagem_livro, 
        l.preco
    FROM tbl_livros AS l
    INNER JOIN tbl_series AS s ON l.id_serie = s.id_serie
    INNER JOIN tbl_Streaming AS p ON s.plataforma = p.nome_streaming WHERE STATUS <> 'INATIVO'";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetch(); // retorna um único resultado
    }

    public function getSerie()
    {
        $sql = "SELECT nome_serie from tbl_series";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getSeriePorId($id)
    {
        $sql = "SELECT * FROM tbl_series WHERE id_serie = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        return $stmt->fetch(); // retorna um único resultado
    }
    public function getSerieComStreamingPorId($id)
    {
        $sql = "SELECT 
                    s.id_serie,
                    s.nome_serie,
                    s.imagem,
                    s.ano_lancamento,
                    s.genero,
                    s.sinopse,
                    st.nome_streaming,
                    st.logo_streaming,
                    st.site_streaming
                FROM 
                    tbl_series s
                JOIN 
                    tbl_Streaming st ON s.plataforma = st.id_streaming
                WHERE 
                    s.id_serie = :id";

        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getLivroSerie($id_serie)
    {
        $sql = "SELECT l.titulo_livros, l.imagem AS imagem_livro, l.preco 
                FROM tbl_livros l 
                WHERE l.id_serie = :id_serie";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id_serie', $id_serie);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getStreaming()
    {
        $sql = "SELECT nome_streaming from tbl_Streaming";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC); // Retorna um array associativo com todos os resultados

    }
    public function editarSerie($id, $dados)
    {
        $sql = "UPDATE tbl_series  
            SET nome_serie = :nome_serie,
                plataforma = :plataforma,
                ano_lancamento = :ano_lancamento,
                genero = :genero,
                sinopse = :sinopse";

        if (!empty($dados['imagem'])) {
            $sql .= ", imagem = :imagem";
        }

        $sql .= " WHERE id_serie = :id";

        $stmt = $this->db->prepare($sql);

        $stmt->bindValue(':id', (int) $id, PDO::PARAM_INT);
        $stmt->bindValue(':nome_serie', $dados['nome_serie']);
        $stmt->bindValue(':plataforma', $dados['plataforma']);
        $stmt->bindValue(':ano_lancamento', $dados['ano_lancamento']);
        $stmt->bindValue(':genero', $dados['genero']);
        $stmt->bindValue(':sinopse', $dados['sinopse']);

        if (!empty($dados['imagem'])) {
            $stmt->bindValue(':imagem', $dados['imagem']);
        }

        return $stmt->execute();
    }
    public function AdicionarSerie($dados)
    {
    

        $nome_serie = $dados['nome_serie'];
        $imagem = $dados['imagem'];
        $plataforma = $dados['plataforma'];
        $ano_lancamento = $dados['ano_lancamento'];
        $genero = $dados['genero'];
        $sinopse = $dados['sinopse'];

        $stmt = $this->db->prepare("
        INSERT INTO tbl_series (nome_serie, imagem, plataforma, ano_lancamento, genero, sinopse)
        VALUES (:nome_serie, :imagem, :plataforma, :ano_lancamento, :genero, :sinopse)
    ");

        $stmt->bindParam(':nome_serie', $nome_serie);
        $stmt->bindParam(':imagem', $imagem);
        $stmt->bindParam(':plataforma', $plataforma);
        $stmt->bindParam(':ano_lancamento', $ano_lancamento);
        $stmt->bindParam(':genero', $genero);
        $stmt->bindParam(':sinopse', $sinopse);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }




    // public function getImgStreamingPorId($id){
    //     $sql = "SELECT logo_streaming FROM tbl_streaming WHERE id_streaming = :id ORDER BY RAND()";
    //     $stmt = $this->db->prepare($sql);
    //     $stmt->bindValue(':id', $id);
    //     $stmt->execute();
    //     return $stmt->fetch(PDO::FETCH_ASSOC);
}
