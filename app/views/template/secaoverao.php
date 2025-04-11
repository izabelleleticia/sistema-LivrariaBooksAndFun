<section class="secaoVerao">
    <div class="linha"></div>
    <h1>Quando um livro é bom demais… ele vira série.</h1>
    <h1>Conheça os livros que deram origem à série:</h1>
    <h1><?php echo $serie['nome_serie']; ?></h1>
    </h1>

    <a href="<?php echo $serie['site_streaming']; ?>" target="_blank" rel="noopener noreferrer">
        <img src="<?php echo BASE_URL . 'uploads/' . $serie['imagem']; ?>" alt="Imagem da série">
    </a>

</section>

<section class="background">
    <div class="Infos">
        <h1>Onde assistir?</h1>

        <div class="canalStreaming">
            <img src="<?php echo BASE_URL . 'uploads/' . $serie['logo_streaming']; ?>"
                alt="<?php echo $serie['nome_streaming']; ?>">
            <h3><?php echo $serie['nome_streaming']; ?></h3>
        </div>

        <div class="paragrafoStreaming">
            <p><?php echo $serie['sinopse']; ?></p>
        </div>
    </div>
</section>