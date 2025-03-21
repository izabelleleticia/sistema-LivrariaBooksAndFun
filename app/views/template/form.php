<section class="formContato">
            <article class="site">
                <div>
                    <h2>Contato - BooksAndFun</h2>
                    <form action="email.php" method="POST">
                        <div>
                            <label for="nome">Nome:</label>
                            <input type="text" id="nome" name="nome" placeholder="Digite seu nome" required>
                        
                            <label for="fone">Telefone:</label>
                            <input type="tel" id="fone" name="fone" placeholder="Digite seu telefone com DDD" required>
                        
                        
                            <label for="email">E-mail:</label>
                            <input type="email" id="email" name="email" placeholder="Digite seu email" required>
                        
                        
                            <label for="mensagem">Mensagem:</label>
                            <textarea id="mensagem" name="mensagem" placeholder="Digite aqui sua mensagem" required></textarea>
                        
                        <div>
                            <input type="submit" value="ENVIAR">
                            <input type="reset" value="LIMPAR">
                        </div>
                    </div>
                    <div></div>
                    </form>
</div>
            </article>
        </section>
        <footer>
        <?php require_once('conteudo/rodape.php');?>
        </footer>
        <!--JQUERY obrigatório para animação-->
    <script type="text/javascript" src="//code.jquery.com/jquery-3.7.1.min.js"></script> 
    <script type="text/javascript" src="//code.jquery.com/jquery-migrate-3.5.0.min.js"></script>
    <!--Animação CARROSSEL Slick-->
    <script type="text/javascript" src="js/slick.min.js"></script>
    <script src="js/lity.js"></script>
    <!--Minha animação sempre por último-->
    <script type="text/javascript" src="js/js.animation.js"></script>
    </main>
</body>
</html>