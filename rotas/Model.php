<?php

class Model
{

    private $pdo;

    protected $db;

    public function __construct()
    {


        try {
            //Cria uma conexao com o banco
            $this->db = new PDO('mysql:dbname=' . DB_NAME . ';host=' . DB_HOST, DB_USER, DB_PASS);
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        } catch (PDOException $e) {
            echo "Falha de conexao:" . $e->getMessage();


        }



    }
    public function getConexao()
    {
        return $this->pdo;
    }
}