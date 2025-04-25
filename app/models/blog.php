<?php 
class Blog extends Model {

    public function getAutorELivros() {
        // Consulta para pegar um autor aleatório
        $sqlAutor = "SELECT a.id_autor, a.nome_autor, a.imagem, a.nacionalidade_autor, a.biografia
                     FROM tbl_autores AS a
                     ORDER BY RAND() LIMIT 1"; // Retorna um autor aleatório
        
        $stmtAutor = $this->db->query($sqlAutor);
        $autor = $stmtAutor->fetch(PDO::FETCH_ASSOC); // Pega o autor aleatório

        // Agora pegamos todos os livros do autor selecionado
        if ($autor) {
            $sqlLivros = "SELECT l.titulo_livros, l.imagem AS imagem_livro, l.preco
                          FROM tbl_livros AS l
                          WHERE l.id_autor = :id_autor"; // Filtra os livros pelo id_autor
                          
            $stmtLivros = $this->db->prepare($sqlLivros);
            $stmtLivros->bindParam(':id_autor', $autor['id_autor'], PDO::PARAM_INT);
            $stmtLivros->execute();
            
            // Pegando todos os livros do autor
            $livros = $stmtLivros->fetchAll(PDO::FETCH_ASSOC);
            
            // Adicionando os livros ao array do autor
            $autor['livros'] = $livros;
        }

        return $autor; // Retorna o autor e seus livros
    }

}
