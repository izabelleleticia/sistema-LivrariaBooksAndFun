<section class="secaoVerao">
    <div class="linha"></div>
    <h1>Quando um livro é bom demais… ele vira série.</h1>
<h1>Descubra: <?php echo $serie['nome_serie']; ?></h1>
    <a href="<?php echo $serie['site_streaming']; ?>" target="_blank" rel="noopener noreferrer">
   <div class=imagemSerie><img src="<?php echo BASE_URL . 'uploads/' . $serie['imagem']; ?>" alt="Imagem da série"></div>
</a>
</section>
<section class="background">
    <div class="Infos">
        <h1>Onde assistir?</h1>
            <div class="canalStreaming">
            <a href="<?php echo $serie['site_streaming']; ?>"><img src="<?php echo BASE_URL . 'uploads/' . $serie['logo_streaming']; ?>" alt="<?php echo $serie['nome_streaming']; ?>"></a>
               <a href="<?php echo $serie['site_streaming'];?>"><h3><?php echo $serie['nome_streaming']; ?></h3></a> 
            </div>
        <div class="paragrafoStreaming">
            <p><?php echo $serie['sinopse']; ?></p>
        </div>
    </div>

</section>
<section class="LivrosSerie">
    <div class="">
        <h1>Livros da Série:</h1>
    </div>
</section>