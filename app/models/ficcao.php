<?php 

class Ficcao extends Model{

    public function getFiccao(){
        $sql = "SELECT l.id_livros, l.titulo_livros, l.imagem, l.preco
        FROM tbl_livros l 
        INNER JOIN tbl_generos g ON l.id_genero = g.id_genero
        WHERE l.id_genero = 3";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
 
}

