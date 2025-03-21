<section class="formContato">
    <article class="site">
        <h1>CADASTRO</h1>
        <div class="contato-container">

            <form action="cadastro.php" method="POST">
                <div class="campo">
                    <label for="nome">Nome completo :</label> 
                    <input type="text" id="nome" name="nome" placeholder="" required>
                </div>

                <div class="campo">
                    <label for="email">E-mail:</label>
                    <input type="email" id="email" name="email" placeholder="" required>
                </div>

                <div class="campo">
                    <label for="senha">Senha:</label>
                    <input type="password" id="password" name="senha" placeholder="" required>
                </div>

                

                <div class="botoes">
                    <button type="submit" name="cadastrar" class="btn-enviar">
                        <img src="img/send.png" alt="Ícone de enviar"> ENVIAR
                    </button>

                    <button type="reset" class="btn-enviar">
                        <img src="img/limpar.png" alt="Ícone de enviar"> LIMPAR
                    </button>
                </div>
            </form>
            <div class="mensagem"> <a href="<?php echo BASE_URL; ?>login.php"><p>Já possui um login? Clique aqui </p></a></div>
           
        </div>
    </article>
</section>
    <?php
    require_once "Cadastro.php"; // Chama a classe de usuário

    if (isset($_POST['cadastrar'])) {
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $senha = $_POST['senha'];

        $usuario = new Cadastro(); // Instancia a classe
        $resultado = $usuario->cadastrar($nome, $email, $senha);

        if ($resultado === true) {
            echo "<p style='color:green;'>Usuário cadastrado com sucesso!</p>";
        } else {
            echo "<p style='color:red;'>$resultado</p>";
        }
    }
    ?>
</body>
</html>
