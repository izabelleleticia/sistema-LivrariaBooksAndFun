<?php
//O modelo contém a lógica da aplicação, como regras de negócio, persistência com o banco de dados e classes de entidade
class Livro extends Model
{

    public function getLivro()
    {
        $sql = "SELECT * FROM tbl_livros where estoque <> 0 order by titulo_livros";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getLivroInfo($id)
    {
        $sql = "SELECT l.id_livros, l.titulo_livros, l.imagem, g.descricao_genero, l.ano_publicacao, l.preco, l.estoque, e.nome_editora FROM tbl_livros AS l INNER JOIN tbl_generos AS g ON l.id_genero = g.id_genero INNER JOIN tbl_editoras AS e ON l.id_editora = e.id_editora WHERE id_livros = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        return $stmt->fetch();
    }
   public function getInformacoesLivros(){
    $sql = "SELECT l.id_livros, l.titulo_livros, l.imagem, g.descricao_genero, l.ano_publicacao, l.preco, l.estoque, e.nome_editora FROM tbl_livros AS l INNER JOIN tbl_generos AS g ON l.id_genero = g.id_genero INNER JOIN tbl_editoras AS e ON l.id_editora = e.id_editora";
      // Prepara a consulta SQL
      $stmt = $this->db->prepare($sql);
    
      // Executa a consulta
      $stmt->execute();
      
      // Retorna todos os resultados encontrados (fetchAll) como um array associativo
      return $stmt->fetchAll(PDO::FETCH_ASSOC);
   }
   public function getEditora(){
    $sql = "select nome_editora from tbl_editoras;";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetch();
   }
   public function editarLivro($dados) {
    $sql = "UPDATE tbl_livros  
    INNER JOIN tbl_editoras ON tbl_livros.id_editora = tbl_editoras.id_editora
INNER JOIN tbl_generos ON tbl_livros.id_genero = tbl_generos.id_genero
SET
            tbl_livros.titulo_livros = :titulo_livros,
            tbl_generos.descricao_genero = :descricao_genero,
            tbl_livros.ano_publicacao = :ano_publicacao,
            tbl_livros.preco = :preco,
            tbl_livros.estoque = :estoque,
            tbl_editoras.nome_editora = :nome_editora";


    // Verifica se a foto foi enviada para ser atualizada
    if (!empty($dados['imagem'])) {
        $sql .= ", imagem = :imagem";  // Adiciona a coluna foto_servico no SQL
    }
    
    // Adiciona a cláusula WHERE
    $sql .= " WHERE id_livros = :id";

    // Prepara a consulta
    $stmt = $this->db->prepare($sql);

    // Faz o binding dos parâmetros
    $stmt->bindValue(':id', (int)$dados['id_livros'], PDO::PARAM_INT);
    $stmt->bindValue(':titulo_livros', $dados['titulo_livros']);
    $stmt->bindValue(':descricao_genero', $dados['descricao_genero']);
    $stmt->bindValue(':ano_publicacao', $dados['ano_publicacao']);
    $stmt->bindValue(':preco', $dados['preco']);
    $stmt->bindValue(':estoque', $dados['estoque']);
    $stmt->bindValue(':nome_editora', $dados['nome_editora']);
   

    // Se a foto não estiver vazia, faz o binding do valor
    if (!empty($dados['imagem'])) {
        $stmt->bindValue(':imagem', $dados['imagem']);
    }

    // Executa a consulta e retorna o resultado
    return $stmt->execute();
}



}