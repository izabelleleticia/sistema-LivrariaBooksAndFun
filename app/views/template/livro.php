<section class="Colunas">
    <div class="imgInfo">
    <img src="<?php echo BASE_URL . 'uploads/' . $livros['imagem'] ?>" alt="" class="zoom-imagem">
    <h3>Preço</h3>
        <p><?php echo $livros['preco'] ?></p>
        <button class="quantidade">Quantidade: <?php echo $livros['estoque'] ?></button>
    </div>


    <div class="SobreLivro">
        <h1><?php echo $livros['titulo_livros'] ?></h1>
        <h2><?php echo $livros['nome_autor'] ?></h2>
        <p><?php echo $livros['descricao_livro'] ?></p>
        <h2><?php echo $livros['descricao_genero'] ?></h2>
        <div class="EditoraePub">

            <div class="editora">
                <p>Editora</p>
                <img src="<?php echo BASE_URL; ?>assets/img/editora.png" alt="">
                <p class="bold"><?php echo $livros['nome_editora'] ?></p>
            </div>

            <div class="publicacao">
                <p>Data da publicação</p>
                <img src="<?php echo BASE_URL; ?>assets/img/calendario.png" alt="">
                <p class="bold"><?php echo $livros['ano_publicacao'] ?></p>
            </div>



        </div>

    </div>

    <!-- Modal -->
    <div id="modalImagem" class="modal">
        <span class="fechar">&times;</span>
        <img class="modal-conteudo" id="imgModal">
    </div>


</section>

<!-- Botão do WhatsApp flutuante com mensagem -->
<div class="whatsapp-container">
    <div class="mensagem-whatsapp">
        Deseja comprar? Entre em contato pelo WhatsApp!
    </div>
    <a href="<?= $link_whatsapp ?>" class="whatsapp-flutuante" target="_blank">
        <img src="<?php echo BASE_URL; ?>assets/img/whatsapp.png" alt="WhatsApp">
    </a>
</div>

<script>
document.addEventListener("DOMContentLoaded", function () {
    var modal = document.getElementById("modalImagem");
    var modalImg = document.getElementById("imgModal");
    var img = document.querySelector(".zoom-imagem");
    var fechar = document.querySelector(".fechar");

    img.addEventListener("click", function () {
        modal.style.display = "block";
        modalImg.src = this.src;
    });

    fechar.addEventListener("click", function () {
        modal.style.display = "none";
    });

    // Fechar o modal ao clicar fora da imagem
    window.addEventListener("click", function (event) {
        if (event.target === modal) {
            modal.style.display = "none";
        }
    });
});
</script>



  

