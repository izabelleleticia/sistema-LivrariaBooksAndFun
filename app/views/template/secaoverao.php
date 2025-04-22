<section class="secaoVerao">
    <div class="linha"></div>
    <header>
        <h1>Quando um livro é bom demais... ele ganha as telas.</h1>
        <h1><?php echo $seriesHome['nome_serie']; ?></h1>
    </header>
    <figure class="imagem">
        <a href="<?php echo $seriesHome['site_streaming']; ?>" target="_blank" rel="noopener noreferrer">
            <img src="<?php echo BASE_URL . 'uploads/' . $seriesHome['imagem_serie']; ?>" alt="Imagem da série">
        </a>
    </figure>
</section>

<section class="background">
    <div class="Infos">
        <header>
            <h1>Onde assistir?</h1>
        </header>

        <article class="canalStreaming">
            <img class="logoImagem" src="<?php echo BASE_URL . 'uploads/' . $seriesHome['logo_streaming']; ?>"
                alt="<?php echo $seriesHome['nome_streaming']; ?>">
            <h3><?php echo $seriesHome['nome_streaming']; ?></h3>
        </article>

        <div class="paragrafoStreaming">
            <p><?php echo $seriesHome['sinopse']; ?></p>
        </div>
    </div>
</section>
<h2>Explore os livros que deram origem às adaptações, seja na TV ou no cinema.</h2>
<section class="teste">
   
    <?php foreach ($livrosDaSerie as $livro): ?>
        <article class="livro-item">
            <div class="infos">
                <img src="<?php echo BASE_URL . 'uploads/' . $livro['imagem_livro']; ?>" alt="Capa do livro">
                <p><?php echo $livro['titulo_livros']; ?></p>
                <p>Preço: R$ <?php echo number_format($livro['preco'], 2, ',', '.'); ?></p>
            </div>

        </article>
    <?php endforeach; ?>
</section>