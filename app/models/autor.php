<?php

class Autor extends Model
{
    public function getAutores()
    {
        $sql = "select nome_autor from tbl_autores";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();

    }
}
