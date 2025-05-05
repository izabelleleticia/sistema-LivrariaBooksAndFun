<section class="secaoVerao">
    <div class="linha"></div>
    <header>
        <!-- <?php var_dump($seriesHome[0]['id_serie'])?> -->
        <h1>Quando um livro é bom demais... ele ganha as telas.</h1>
        <!-- Acessando corretamente o primeiro elemento de $seriesHome -->
        <h1><?php echo $seriesHome[0]['nome_serie']; ?></h1>
    </header>
    <figure class="imagem">
        <!-- Alterando o índice para usar $seriesHome[0] ao invés de $seriesHome[1] -->
        <a href="<?php echo $seriesHome[0]['site_streaming']; ?>" target="_blank" rel="noopener noreferrer">
            <img src="<?php echo BASE_URL . 'uploads/' . $seriesHome[0]['imagem_serie']; ?>" alt="Imagem da série">
        </a>
    </figure>
</section>

<section class="background">
    <div class="Infos">
        <header>
            <h1>Onde assistir?</h1>
        </header>

        <article class="canalStreaming">
            <!-- Alterando para usar o índice correto de $seriesHome -->
             <a href="<?php echo $seriesHome[0]['site_streaming']?>" target="_blank">  <img class="logoImagem" src="<?php echo BASE_URL . 'uploads/' . $seriesHome[0]['logo_streaming']; ?>"
             alt="<?php echo $seriesHome[0]['nome_streaming']; ?> " ></a>
          
            <h3><?php echo $seriesHome[0]['nome_streaming']; ?></h3>
        </article>

        <div class="paragrafoStreaming">
            <p><?php echo $seriesHome[0]['sinopse']; ?></p>
        </div>
    </div>
</section>

<!-- <h2>Explore os livros que deram origem às adaptações, seja na TV ou no cinema.</h2> -->
<section class="teste">

    <?php foreach (($dados['seriesHome']) as $livro): ?>
        <article class="livro-item">
            <div class="infos">
                <!-- Acessando corretamente as chaves do livro -->
                <a href="livro/detalhe/<?php echo $livro['id_livros']; ?>">
                 <img src="<?php echo BASE_URL . 'uploads/' . $livro['imagem_livro']; ?>" alt="Capa do livro">
                 </a>
               
                <p><?php echo $livro['titulo_livros']; ?></p>
                <p>Preço: R$ <?php echo number_format($livro['preco'], 2, ',', '.'); ?></p>
            </div>
        </article>
    <?php endforeach; ?>


</section>