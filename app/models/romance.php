<?php 

class Romance extends Model{

    public function getRomance(){
        $sql = "SELECT l.id_livros, l.titulo_livros, l.imagem, l.preco
        FROM tbl_livros l 
        INNER JOIN tbl_generos g ON l.id_genero = g.id_genero
        WHERE descricao_genero = 'Romance' ORDER BY RAND() LIMIT 4";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
 
}




