<section class="secaoVerao">
    <div class="linha"></div>
    <div class="secaoSerie">
        <div>
            <h1>Quando um livro é bom demais… <br> ele vira série.</h1>
            <h1>Descubra: <br> <?php echo $serie['nome_serie']; ?></h1>
        </div>

        <a href="<?php echo $serie['site_streaming']; ?>" target="_blank" rel="noopener noreferrer">
            <img src="<?php echo BASE_URL . 'uploads/' . $serie['imagem']; ?>" alt="Imagem da série">
        </a>
    </div>

</section>
<section class="background">
    <div class="Infos">
        <h1>Onde assistir?</h1>
        <div class="canalStreaming">
            <a href="<?php echo $serie['site_streaming']; ?>"><img src="<?php echo BASE_URL . 'uploads/' . $serie['logo_streaming']; ?>" alt="<?php echo $serie['nome_streaming']; ?>"></a>
            <a href="<?php echo $serie['site_streaming']; ?>">
                <h3><?php echo $serie['nome_streaming']; ?></h3>
            </a>
        </div>
        <div class="paragrafoStreaming">
            <p><?php echo $serie['sinopse']; ?></p>
        </div>
    </div>

</section>
<?php if (!empty($livroSerie)): ?>
    <h2>Conheça os livros que deram origem à série:</h2>
    <div class="secaoSerie">
        <?php foreach ($livroSerie as $livro): ?>
            <div>
                <img src="<?php echo BASE_URL . 'uploads/' . $livro['imagem_livro']; ?>" alt="">
                <p><?php echo $livro['titulo_livros']; ?><br>R$<?php echo number_format($livro['preco'], 2, ',', '.'); ?></p>
            </div>
        <?php endforeach; ?>
    </div>
<?php else: ?>
    <p>Nenhum livro encontrado.</p>
<?php endif; ?>

</section>