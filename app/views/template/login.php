<section class="formContato">
    <article class="site">
        <h1>LOGIN</h1>
        <div class="contato-container">

            <form action="login.php" method="POST">

                <div class="campo">
                    <label for="email">E-mail:</label>
                    <input type="email" id="email" name="email" placeholder="" required>
                </div>

                <div class="campo">
                    <label for="senha">Senha:</label>
                    <input type="password" id="senha" name="senha" placeholder="" required>
                </div>



                <div class="botoes">
                    <button type="submit" class="btn-enviar" name="logar">
                        <img src="<?php echo BASE_URL; ?>assets/img/send.png" alt="Ícone de enviar"> ENVIAR
                    </button>

                    <button type="reset" class="btn-enviar">
                        <img src="<?php echo BASE_URL; ?>assets/img/limpar.png" alt="Ícone de enviar"> LIMPAR
                    </button>
                </div>
            </form>
        </div>
    </article>
</section>

<?php
require_once "Usuario.php"; // Chama a classe de usuário

if (isset($_POST['logar'])) {
    // Verifique se as variáveis existem no array $_POST
    if (isset($_POST['email']) && isset($_POST['senha'])) {
        $email = $_POST['email'];
        $senha = $_POST['senha'];

        $usuario = new Cadastro(); // Instancia a classe Usuario
        $resultado = $usuario->logar($email, $senha);

        // Exibe mensagem de sucesso ou erro
        if ($resultado === true) {
            echo "<p style='color:green;'>Usuário logado com sucesso!</p>";
        } else {
            echo "<p style='color:red;'>$resultado</p>";
        }
    } else {
        echo "<p style='color:red;'>Por favor, preencha todos os campos.</p>";
    }
}
?>


</body>

</html>