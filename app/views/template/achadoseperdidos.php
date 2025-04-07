<section class="SecaoAchados">
    <article class="site">
    <div class="AchadosTexto">
    <h1>Seção dos Achados e Perdidos</h1>
    <p>Ainda está em dúvida sobre o que comprar? Descubra nossas categorias e encontre o que você procura:</p>
</div>

<div class="h2">
    <h2>Ficção</h2>
</div>

<div class="livrosFiccao">
    <?php if (!empty($ficcao)) : ?>
        <?php foreach ($ficcao as $livro) : ?>
            <div>
                <a href="<?php echo BASE_URL . 'livro/' . $livro['id_livros']; ?>">
                    <img src="<?php echo BASE_URL . 'uploads/' . $livro['imagem']; ?>" alt="">
                </a>
                <p><?php echo $livro['titulo_livros']; ?> <br>R$<?php echo($livro['preco']); ?></p>
            </div>
        <?php endforeach; ?>
    <?php else : ?>
        <p>Nenhum livro de ficção disponível no momento.</p>
    <?php endif; ?>
</div>


        <div class="h2">
            <h2>Romance</h2>
        </div>
        <div class="livrosRomance">
    <?php if (!empty($romance)) : ?>
        <?php foreach ($romance as $livro) : ?>
            <div>
                <a href="<?php echo BASE_URL . 'livro/' . $livro['id_livros']; ?>">
                    <img src="<?php echo BASE_URL . 'uploads/' . $livro['imagem']; ?>" alt="">
                </a>
                <p><?php echo $livro['titulo_livros']; ?><br>R$<?php echo number_format($livro['preco'], 2, ',', '.'); ?></p>
            </div>
        <?php endforeach; ?>
    <?php else : ?>
        <p>Nenhum livro de romance encontrado.</p>
    <?php endif; ?>
</div>



        <h2>Conheça: A Trilogia que Virou Série</h2>
        <div class="secaoSerie">
            <div>
                <img src="<?php echo BASE_URL; ?>assets/img/overao.jpeg" alt="">
                <p>O verão que mudou minha vida <br>R$50,00</p>
            </div>
            <div>
                <img src="<?php echo BASE_URL; ?>assets/img/que.jpeg" alt="">
                <p>Sem você não é verão<br>R$50,00</p>
            </div>
            <div>
                <img src="<?php echo BASE_URL; ?>assets/img/mudouminhavida.jpeg" alt="">
                <p>Sempre teremos o nosso verão<br>R$50,00</p>
            </div>
        </div>


    </article>

</section>