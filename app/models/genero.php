<?php 

class Genero extends Model{

    public function getGenero(){
        $sql = "select * from tbl_generos";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getGeneroSerie(){
        $sql = "SELECT genero from tbl_series";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC); // Retorna um array associativo com todos os resultados
    }
  
}

