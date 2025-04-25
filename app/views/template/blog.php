<section class="blogInfos">
    <h1>Resenhas e Recomendações</h1>
    <p>Os 6 livros que todo amante da literatura precisa ler:</p>
    <div class="Recomendacoes">
        <div>
            <img src="<?php echo BASE_URL; ?>assets/img/domquixotee.webp" alt="Domquixote">
            <p>Dom Quixote <br> 
            Miguel de Cervantes</p>
        </div>
        <div>
            <img src="<?php echo BASE_URL; ?>assets/img/1984.jpg" alt="Domquixote">
            <p>1984 <br>
            George Orwell
            </p>
        </div>
        <div>
            <img src="<?php echo BASE_URL; ?>assets/img/orgulhoepreconceito.webp" alt="Domquixote">
            <p>Orgulho e Preconceito <br>
            Jane Austen
            </p>
        </div>
        <div>
            <img src="<?php echo BASE_URL; ?>assets/img/osoleparatodos.jpg" alt="Domquixote">
            <p>O Sol é Para Todos <br>
            Harper Lee
            </p>
        </div>
        <div>
            <img src="<?php echo BASE_URL; ?>assets/img/cemanosdesolidao.jpg" alt="Domquixote">
            <p>Cem Anos de Solidão <br>
            Gabriel García Márquez
            </p>
        </div>
        <div>
            <img src="<?php echo BASE_URL; ?>assets/img/ograndegatsby.jpg" alt="Domquixote">
            <p>O Grande Gatsby <br> F. Scott Fitzgerald
            </p>
        </div>
    </div>
</section>
<section class="curiosidades">
    <h1>Biografia de nossos autores preferidos</h1>
    <div class="fotoTexto">
        <!-- Exibindo a imagem do autor -->
        <img src="<?php echo isset($autor['imagem']) && !empty($autor['imagem']) ? BASE_URL . 'uploads/' . $autor['imagem'] : BASE_URL . 'assets/img/semfoto.png'; ?>" alt="Imagem do Autor" class="card-img-top" style="height: 250px; object-fit: cover;">
        <p><?php echo ($autor['biografia']); ?></p>
    </div>
    <div class="linha">
        <h2><?php echo ($autor['nome_autor']); ?></h2>
    </div>

    <!-- Exibindo os livros do autor -->
    <div class="Obras">
        <h3>Conheça suas obras mais famosas</h3>
        <div class="autor">
            <?php if (!empty($autor['livros'])): ?>
                <?php foreach ($autor['livros'] as $livro): ?>
                    <div>
                        <img src="<?php echo BASE_URL . 'uploads/' . $livro['imagem_livro']; ?>" alt="">
                        <p><?php echo $livro['titulo_livros']; ?></p>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Este autor não possui livros cadastrados.</p>
            <?php endif; ?>
        </div>
    </div>
</section>
        <div class="botao"><button><img src="<?php echo BASE_URL; ?>assets/img/comprar.png" alt="">Quero comprar!</button></div>
    </div>
    <div class="Filme">
        <h1>É assim que acaba - O filme</h1>
        <img src="<?php echo BASE_URL; ?>assets/img/eassimqueacabafilme.webp" alt="filme">
    </div>
    <div class="backInfos">
        <h3>Onde assistir?</h3>
        <div class="Streaming">
            <div class="canalStreaming">
                <img src="<?php echo BASE_URL; ?>assets/img/max.webp" alt="max">
                <p>Disponível para assinantes sem custo adicional.</p>
            </div>
            <div class="canalStreaming">
                <img src="<?php echo BASE_URL; ?>assets/img/amazon.png" alt="amazon">
                <p>Disponível para compra ou aluguel.</p>
            </div>
            <div class="canalStreaming">
                <img src="<?php echo BASE_URL; ?>assets/img/appletv.webp" alt="appletv">
                <p>Disponível para compra ou aluguel.</p>
            </div>
<p>Além disso, o filme está disponível para compra ou aluguel em outras plataformas digitais, como o YouTube Filmes.</p>
        </div>
    </div>
</section>