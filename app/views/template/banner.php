<section class="banner">
    <div>
<h1>Encontre seu próximo livro</h1>
    <img src="<?php echo BASE_URL; ?>assets/img/livraria.img.png" alt="Banner 1">

    </div>
</section>
<style>
.banner h1 {
    opacity: 0;
    transform: translateY(-20px);
    transition: opacity 1.5s ease, transform 1.5s ease;
    /* Deixa o h1 invisível e deslocado pra cima no começo */
}

.banner h1.aparecer {
    opacity: 1;
    transform: translateY(0);
    /* Quando a classe "aparecer" for adicionada, ele aparece e volta para o lugar */
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const titulo = document.querySelector('.banner h1');

    if (titulo) { // Confirma que o h1 existe
        setTimeout(function() {
            titulo.classList.add('aparecer');
        }, 500); // meio segundo depois que a página carregar
    } else {
        console.error('Título não encontrado!');
    }
});
</script>
