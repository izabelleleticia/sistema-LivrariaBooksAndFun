<section class="formContato">
    <article class="site">
        <h1>CADASTRO</h1>
        <div class="contato-container">

            <form action="http://localhost/sistema-LivrariaBooksAndFun/public/cadastro/cadastrar" method="POST">
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
                    <button type="submit" class="btn-enviar">
                    <img src="<?php echo BASE_URL; ?>assets/img/send.png" alt="Ícone de enviar"> ENVIAR
                    </button>

                    <button type="reset" class="btn-enviar">
                    <img src="<?php echo BASE_URL; ?>assets/img/limpar.png" alt="Ícone de enviar"> LIMPAR
                    </button>
                </div>
            </form>

            <div class="mensagem">
                <a href="<?php echo BASE_URL; ?>login"><p>Já possui um login? Clique aqui</p></a>
            </div>
        </div>
    </article>
</section>
