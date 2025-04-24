<?php 
class Destaques extends model {
    public function getLivrosMaisClicados()
    {
        $sql = "SELECT * FROM tbl_livros 
                ORDER BY cliques DESC 
                LIMIT 5";
        $stmt = $this->db->query($sql);
        $livros = $stmt->fetchAll();
    
        // Embaralhar os 5 mais clicados para mostrar de forma aleatória
        shuffle($livros);
    
        return $livros;
    }
}    
    
