<form class="row g-3" method="POST" enctype="multipart/form-data" action="http://localhost/sistema-LivrariaBooksAndFun/public/livro/editar/<?php echo $dadosLivro['id_livros'];?>">
<?php var_dump ($dadosLivro)?>;
<input type="hidden" name="id_livros" value="<?php echo $dadosLivro['id_livros']; ?>">

<div class="row">
    <!-- IMAGEM -->
    <div class="col-md-3">
        <?php
        $fotoPath = !empty($dadosLivro['imagem']) 
                   ? BASE_URL . 'uploads/' . $dadosLivro['imagem']
                   : BASE_URL . 'assets/img/sem-foto.jpg';
        ?>
        <img id="preview" class="rounded-2" src="<?= htmlspecialchars($fotoPath) ?>" 
             alt="Capa do livro" 
             style="margin-left:50px; width:250px; height:320px; object-fit:cover; cursor:pointer;"
             title="Clique para alterar a capa">
        <input type="file" name="imagem" id="imagem" style="display:none;" accept="image/*">
        <input type="hidden" name="foto_atual" value="<?= htmlspecialchars($dadosLivro['imagem'] ?? '') ?>">
    </div>

    <!-- COLUNA 1 -->
<div class="col-md-3 ms-0 ps-2">
    <div class="mb-1">
        <label for="nome_servico" class="form-label">Título do Livro</label>
        <input type="text" class="form-control" id="nome_servico" name="titulo_livros" required 
               value="<?php echo $dadosLivro['titulo_livros']; ?>">
    </div>
    <div class="mb-1">
        <label for="descricao_livro" class="form-label">Descricão</label>
        <input type="text" class="form-control" id="descricao_livro" name="descricao_livro" required 
               value="<?php echo $dadosLivro['descricao_livro']; ?>">
    </div>

    <div class="mb-3">
        <label for="nome_autor" class="form-label">Autor</label>
        <select class="form-select" id="nome_autor" name="nome_autor" required>
            <?php foreach ($dados['autores'] as $linha): ?> 
                <option value="<?php echo $linha['nome_autor']; ?>" 
                    <?php echo ($linha['nome_autor'] == $dadosLivro['nome_autor']) ? 'selected' : ''; ?>>
                    <?php echo $linha['nome_autor']; ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="mb-3">
        <label for="descricao_genero" class="form-label">Gênero</label>
        <select class="form-select" id="descricao_genero" name="descricao_genero" required>
            <?php foreach ($dados['generos'] as $linha): ?> 
                <option value="<?php echo $linha['descricao_genero']; ?>" 
                    <?php echo ($linha['descricao_genero'] == $dadosLivro['descricao_genero']) ? 'selected' : ''; ?>>
                    <?php echo $linha['descricao_genero']; ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="mb-3">
        <label for="nome_editora" class="form-label">Editora</label>
        <select class="form-select" id="nome_editora" name="nome_editora" required>
            <?php foreach ($dados['editoras'] as $linha): ?>
                <option value="<?php echo $linha['nome_editora']; ?>" 
                    <?php echo ($linha['nome_editora'] == $dadosLivro['nome_editora']) ? 'selected' : ''; ?>>
                    <?php echo $linha['nome_editora']; ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>
</div>

<!-- COLUNA 2 -->
<div class="col-md-5">
    <div class="mb-3">
        <label for="preco" class="form-label">Preço</label>
        <input type="number" class="form-control" id="preco" name="preco" required 
               value="<?php echo $dadosLivro['preco']; ?>">
    </div>

    <div class="mb-3">
        <label for="estoque" class="form-label">Estoque</label>
        <input type="number" class="form-control" id="estoque" name="estoque" required 
               value="<?php echo $dadosLivro['estoque']; ?>">
    </div>

    <div class="mb-3">
        <label for="ano_publicacao" class="form-label">Ano de Publicação</label>
        <input type="number" min="1000" max="2099" class="form-control" id="ano_publicacao" name="ano_publicacao" 
               required value="<?php echo $dadosLivro['ano_publicacao'] ?? ''; ?>">
    </div>

    <div class="col-md-12">
    <label for="id_serie" class="form-label">Série</label>
    <select class="form-select" id="nome_serie" name="nome_serie">
    <option value="" <?php echo empty($dadosLivro['nome_serie']) ? 'selected' : ''; ?>></option>
    <?php foreach ($dados['series'] as $linha): ?>
        <option value="<?php echo $linha['nome_serie']; ?>" 
            <?php echo ($linha['nome_serie'] == $dadosLivro['nome_serie']) ? 'selected' : ''; ?>>
            <?php echo $linha['nome_serie']; ?>
        </option>
    <?php endforeach; ?>
</select>

</div>


</div>

<!-- BOTÕES -->
<div class="col-12 d-flex justify-content-between mt-3">
    <button type="submit" class="btn btn-primary">Editar</button>
    <button type="reset" class="btn btn-danger">Limpar</button>
</div>
</form>

<script>
document.addEventListener('DOMContentLoaded', function () {
const previewImg = document.getElementById('preview');
const fileInput = document.getElementById('imagem');

previewImg.addEventListener("click", function () {
    fileInput.click();
});

fileInput.addEventListener('change', function () {
    if (fileInput.files && fileInput.files[0]) {
        let reader = new FileReader();
        reader.onload = function (e) {
            previewImg.src = e.target.result;
        };
        reader.readAsDataURL(fileInput.files[0]);
    }
});
});
</script>
