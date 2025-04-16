<?php 

class Genero extends Model{

    public function getGenero(){
        $sql = "select * from tbl_generos";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
  
}

