<?php
class Destaques extends Model{
    public function getDestaques(){
        $sql = "SELECT * FROM tbl_livros ORDER BY RAND() LIMIT 6;";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}