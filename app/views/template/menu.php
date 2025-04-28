<div class="right">
    <div class="search-container">
        <input type="text" class="input-pesquisa" id="searchInput" placeholder="Pesquise o que deseja...">
        <button class="btn-pesquisa" onclick="pesquisar()">
            <img src="<?php echo BASE_URL; ?>assets/img/lupa.png" alt="Pesquisar">
        </button>
    </div>
</div>
<div class="left">
    <div class="LogoNav">
        <img src="<?php echo BASE_URL; ?>assets/img/logomenu.png" alt="Logo">
        <nav>
            <ul>
                <li><a href="<?php echo BASE_URL; ?>home">home</a></li>
                <li><a href="<?php echo BASE_URL; ?>sobre">sobre</a></li>
                <li><a href="<?php echo BASE_URL; ?>blog">blog</a></li>
                <li><a href="<?php echo BASE_URL; ?>contato">contato</a></li>
                <a href="<?php echo BASE_URL; ?>cadastro"><img class="cadastro" src="<?php echo BASE_URL; ?>assets/img/cadastro.png" alt=""></a>
            </ul>
        </nav>
    </div>
</div>
<script>
    function pesquisar() {
        var query = document.getElementById('searchInput').value;
        if (query) {
            window.location.href = "<?php echo BASE_URL; ?>pesquisa?query=" + encodeURIComponent(query);
        } else {
            alert("Por favor, insira um termo de pesquisa.");
        }
    }
</script>

