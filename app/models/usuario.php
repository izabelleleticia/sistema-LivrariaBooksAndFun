<?php

class Usuario extends Model
{
    public function getUsuarios()
    {
        $sql = "SELECT * FROM tbl_usuarios";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getUsuarioPorId($id)
    {
        $sql = "SELECT * FROM tbl_usuarios WHERE id_usuario = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function adicionar($dados)
    {
        try {
            // Verifique se a imagem foi carregada corretamente
            if (empty($dados['imagem'])) {
                // Se a imagem não foi carregada, podemos tratar isso aqui, caso necessário
                throw new Exception("Erro: Imagem não carregada.");
            }
    
            $sql = "INSERT INTO tbl_usuarios (nome_usuario, imagem, email_usuario, senha_usuario)
                    VALUES (:nome_usuario, :imagem, :email_usuario, :senha_usuario)";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':nome_usuario', $dados['nome_usuario']);
            $stmt->bindParam(':imagem', $dados['imagem']);
            $stmt->bindParam(':email_usuario', $dados['email_usuario']);
            $stmt->bindParam(':senha_usuario', $dados['senha_usuario']);
            
            // Execute a query
            if ($stmt->execute()) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            echo 'Erro no banco: ' . $e->getMessage();
            return false;
        } catch (Exception $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function editarUsuario($dados)
    {
        if (isset($dados['senha'])) {
            $sql = "UPDATE tbl_usuarios SET nome_usuario = :nome, email_usuario = :email, senha_usuario = :senha WHERE id_usuario = :id";
        } else {
            $sql = "UPDATE tbl_usuarios SET nome_usuario = :nome, email_usuario = :email WHERE id_usuario = :id";
        }

        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':nome', $dados['nome']);
        $stmt->bindValue(':email', $dados['email']);
        $stmt->bindValue(':id', $dados['id']);

        if (isset($dados['senha'])) {
            $stmt->bindValue(':senha', $dados['senha']);
        }

        return $stmt->execute();
    }

    public function excluirUsuario($id)
    {
        $sql = "DELETE FROM tbl_usuarios WHERE id_usuario = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
