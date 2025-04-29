<?php class Login extends Model
{
    public function getLogin($email)
    {
        // Corrigido: A query agora usa :email e passamos o valor correto para o bindParam
        $sql = "SELECT * FROM tbl_usuarios WHERE email_usuario = :email ";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(":email", $email, PDO::PARAM_STR);
          // Certifique-se de vincular o parâmetro corretamente
        $stmt->execute();

        return $stmt->fetchAll();
    }
}
