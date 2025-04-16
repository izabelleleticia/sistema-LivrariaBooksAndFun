<?php

class Model
{
    // Conexão estática compartilhada entre todos os models
    protected static $db; 
    protected $conexao;

    public function __construct()
    {
        // Verifica se a conexão já existe, caso contrário, cria uma nova
        if (!isset(self::$db)) {
            try {
                self::$db = new PDO(
                    'mysql:dbname=' . DB_NAME . ';host=' . DB_HOST,
                    DB_USER,
                    DB_PASS
                );
                self::$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die("Falha de conexão: " . $e->getMessage());
            }
        }

        // Atribui a conexão estática à instância
        $this->conexao = self::$db;
    }

    // Método público para acessar a conexão ativa, se necessário
    public function getConexao()
    {
        return $this->conexao;
    }

    // Método mágico __get para acessar o banco diretamente
    public function __get($name)
    {
        // Se a propriedade solicitada for 'db', retorna a conexão
        if ($name === 'db') {
            return $this->conexao;
        }
    }
}

?>
