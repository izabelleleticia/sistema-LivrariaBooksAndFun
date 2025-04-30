<?php
class Series extends Model
{
    public function getSeries()
    {
        $sql = "SELECT * from tbl_series";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getSerie()
    {
        $sql = "SELECT nome_serie from tbl_series";
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
    l.id_livros,
    l.titulo_livros, 
    l.imagem AS imagem_livro, 
    l.preco
FROM tbl_series AS s
INNER JOIN tbl_livros AS l ON l.id_serie = s.id_serie
INNER JOIN tbl_Streaming AS p ON s.plataforma = p.nome_streaming
INNER JOIN (
    SELECT s.id_serie
    FROM tbl_series s
    WHERE s.id_serie IN (
        SELECT DISTINCT id_serie FROM tbl_livros WHERE id_serie IS NOT NULL
    ) AND s.id_serie <> 5
    ORDER BY RAND()
    LIMIT 1
) AS serie_sorteada ON s.id_serie = serie_sorteada.id_serie";


        $stmt = $this->db->prepare($sql);
        $stmt->execute();

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
    
        public function getLivroSerie()
    {
        $sql = "SELECT l.titulo_livros, l.imagem AS imagem_livro, l.preco, s.nome_serie, s.imagem AS imagem_serie 
                FROM tbl_livros l 
                INNER JOIN tbl_series s ON l.id_serie = s.id_serie";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC); // Retorna um array associativo com todos os resultados
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

    

    // public function getImgStreamingPorId($id){
    //     $sql = "SELECT logo_streaming FROM tbl_streaming WHERE id_streaming = :id ORDER BY RAND()";
    //     $stmt = $this->db->prepare($sql);
    //     $stmt->bindValue(':id', $id);
    //     $stmt->execute();
    //     return $stmt->fetch(PDO::FETCH_ASSOC);
}


