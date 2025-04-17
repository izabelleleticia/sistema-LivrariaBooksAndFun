<?php class Streaming extends Model
{
    public function getStreaming()
    {
        $sql = "SELECT nome_streaming from tbl_Streaming";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC); // Retorna um array associativo com todos os resultados

    }
   
}
