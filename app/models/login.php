<?php class Login extends Model
{
    public function getLogin($email)
    {
        $sql = "SELECT email_usuario, senha_usuario FROM tbl_usuarios WHERE email_usuario = :email";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(":email", $email, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
