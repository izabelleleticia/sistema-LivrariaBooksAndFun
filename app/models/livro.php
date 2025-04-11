<?php
//O modelo contém a lógica da aplicação, como regras de negócio, persistência com o banco de dados e classes de entidade
class Livro extends Model
{

    public function getLivro()
    {
        $sql = "SELECT * FROM tbl_livros where estoque <> 0 order by titulo_livros;";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getLivroInfo($id)
    {
        $sql = "SELECT l.titulo_livros, l.imagem, g.descricao_genero, l.ano_publicacao, l.preco, l.estoque, e.nome_editora FROM tbl_livros AS l INNER JOIN tbl_generos AS g ON l.id_genero = g.id_genero INNER JOIN tbl_editoras AS e ON l.id_editora = e.id_editora WHERE id_livros = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        return $stmt->fetch();
    }




}