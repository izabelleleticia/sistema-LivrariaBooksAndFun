<?php
class Series extends Model
{
    public function getSeries()
    {
        $sql = "SELECT * from tbl_series";
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
                INNER JOIN 
                    tbl_Streaming st ON s.id_streaming = st.id_streaming
                ORDER BY RAND() LIMIT 1"; // sem WHERE s.id_serie = :id
    
        $stmt = $this->db->prepare($sql);
        $stmt->execute(); // sem bindValue!
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function getLivroSerie(){
        $sql = "SELECT l.titulo_livros, l.imagem AS imagem_livro, l.preco, s.nome_serie, s.imagem AS imagem_serie 
                FROM tbl_livros l 
                INNER JOIN tbl_series s ON l.id_serie = s.id_serie";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC); // Retorna um array associativo com todos os resultados
    }
    
    
    // public function getImgStreamingPorId($id){
    //     $sql = "SELECT logo_streaming FROM tbl_streaming WHERE id_streaming = :id ORDER BY RAND()";
    //     $stmt = $this->db->prepare($sql);
    //     $stmt->bindValue(':id', $id);
    //     $stmt->execute();
    //     return $stmt->fetch(PDO::FETCH_ASSOC);
}


