<section class="formContato">
    <article class="site">
        <h1>Contate-nos</h1>
        <div class="contato-container">

            <form action="email" method="POST">
                <div class="campo">
                    <label for="nome">Nome:</label>
                    <input type="text" id="nome" name="nome" placeholder="" required>
                </div>

                <div class="campo">
                    <label for="fone">Telefone:</label>
                    <input type="tel" id="fone" name="fone" placeholder="" required>
                </div>

                <div class="campo">
                    <label for="email">E-mail:</label>
                    <input type="email" id="email" name="email" placeholder="" required>
                </div>

                <div class="campo">
                    <label for="mensagem">Mensagem:</label>
                    <textarea id="mensagem" name="mensagem" placeholder="" required></textarea>
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
        </div>
    </article>
</section>