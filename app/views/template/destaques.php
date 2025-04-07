<section class="destaques">
    <article class="site">
        <div>
            <h1>Destaques da Semana</h1>
        </div>
        <div class="livrosDestaque">

            <?php foreach ($destaques as $livro): ?>
                <div>
                    <a href="livro?id=<?php echo $livro['id_livros']; ?>">
                    <img src="<?php echo BASE_URL . 'uploads/' . $livro['imagem']; ?>" alt="">
                    </a>
                    <p>
                        <?php echo $livro['titulo_livros']; ?><br>
                    
                    </p>
                    <p>
                        <?php echo $livro['preco']; ?><br>
                    </p>
                </div>
            <?php endforeach; ?>

        </div>
    </article>

    <div class="botao">
        <button>
            <img src="<?php echo BASE_URL; ?>assets/img/icons8-livros-24.png" alt="Ícone">
            Veja mais títulos
        </button>
    </div>
</section>
