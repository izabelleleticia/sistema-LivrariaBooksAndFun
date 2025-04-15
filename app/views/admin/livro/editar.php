<form class="row g-3" method="POST" enctype="multipart/form-data" action="http://localhost/sistema-LivrariaBooksAndFun/public/livro/adicionar">

 <!-- <?php var_dump($dadosLivro);?> -->
 <!-- <?php var_dump($dados['editoras']);?> -->
 
    <input type="hidden" name="id_livros" value="<?php echo $dadosLivro['id_livros']; ?>">
    <div class="col-md-2">
    <?php
    // Verifica e monta o caminho completo da foto
    $fotoPath = !empty($dadosLivro['imagem']) 
               ? BASE_URL . 'uploads/' . $dadosLivro['imagem']
               : BASE_URL . 'assets/img/sem-foto.jpg';
    ?>
    
    <img id="preview" class="rounded-2" src="<?= htmlspecialchars($fotoPath) ?>" 
         alt="Foto do serviço" 
         style="width:100%; height:320px; object-fit:cover; cursor:pointer;"
         title="Clique para alterar a foto">
         
    <input type="file" name="imagem" id="imagem" style="display:none;" accept="image/*">
    <input type="hidden" name="foto_atual" value="<?= htmlspecialchars($dadosLivro['imagem'] ?? '') ?>">
</div>

    <div class="col-md-9">
        <div class="row">
            <div class="col-12">
                <label for="nome_servico" class="form-label">Título do Livro</label>
                <input type="text" class="form-control" id="nome_servico" name="titulo_livros" required 
                       value="<?php echo $dadosLivro['titulo_livros']; ?>">
            </div>
            <div class="col-md-9">
        <div class="row">
            <div class="col-12">
                <label for="descricao_genero" class="form-label">Genero</label>
                <input type="text" class="form-control" id="descricao_genero" name="descricao_genero" required 
                       value="<?php echo $dadosLivro['descricao_genero']; ?>">
            </div>
           
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <label for="preco" class="form-label">Preço</label>
                <input type="number" step="0.01" min="0" class="form-control" id="preco" 
                       name="preco" required value="<?php echo $dadosLivro['preco']; ?>">
            </div>

            <div class="col-md-6">
                <label for="estoque" class="form-label">Estoque</label>
                <input type="value" class="form-control" id="estoque" name="estoque" required 
                       value="<?php echo $dadosLivro['estoque']; ?>">
            </div>
        </div>
        <div class="col-md-6">
    <label for="ano_publicacao" class="form-label">Ano de Publicação</label>
    <input type="number" class="form-control" id="ano_publicacao" name="ano_publicacao" 
           required value="<?php echo $dadosLivro['ano_publicacao'] ?? ''; ?>">
</div>

        <div class="col-md-4">
        <label for="nome_editora" class="form-label">Editora</label>
<!-- <?php var_dump($dados['editoras']); ?> -->

<select class="form-select" id="nome_editora" name="nome_editora" required>
    <?php foreach ($dados['editoras'] as $linha): ?>
        <option value="<?php echo $linha['nome_editora']; ?>" 
            <?php echo ($linha['nome_editora'] == $dadosLivro['nome_editora']) ? 'selected' : ''; ?>>
            <?php echo $linha['nome_editora']; ?>
        </option>
    <?php endforeach; ?>
</select>

        <div class="col-md-12" style="display: flex; justify-content: space-between; margin-top: 20px;">
            <button type="submit" class="btn btn-primary">Editar</button>
            <button type="reset" class="btn btn-danger">Limpar</button>
        </div>
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
