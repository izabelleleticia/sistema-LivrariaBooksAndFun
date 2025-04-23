<!-- admin/autores/editar.php -->
 
<form method="POST" action="<?= BASE_URL ?>autor/editar/<?= $autor['id_autor'] ?>">
    <h2>Editar Autor</h2>

    <!-- Mensagem de erro ou sucesso -->
    <?php if (isset($dados['mensagem'])): ?>
        <div class="alert <?= isset($dados['tipo-msg']) && $dados['tipo-msg'] == 'sucesso' ? 'alert-success' : 'alert-danger' ?>">
            <?= $dados['mensagem'] ?>
        </div>
    <?php endif; ?>
    <div class="col-md-3">
        <?php
        $fotoPath = !empty($autor['imagem']) 
                   ? BASE_URL . 'uploads/' . $autor['imagem']
                   : BASE_URL . 'assets/img/sem-foto.jpg';
        ?>
        <img id="preview" class="rounded-2" src="<?= htmlspecialchars($fotoPath) ?>" 
             alt="Capa do livro" 
             style="margin-left:50px; width:250px; height:320px; object-fit:cover; cursor:pointer;"
             title="Clique para alterar a capa">
        <input type="file" name="imagem" id="imagem" style="display:none;" accept="image/*">
        <input type="hidden" name="foto_atual" value="<?= htmlspecialchars($autor['imagem'] ?? '') ?>">
    </div>
    <div class="form-group">
        <label for="nome_autor">Nome do Autor</label>
        <input type="text" id="nome_autor" name="nome_autor" class="form-control" required value="<?= $autor['nome_autor'] ?>">
    </div>

    <div class="form-group">
        <label for="nacionalidade_autor">Nacionalidade do Autor</label>
        <input type="text" id="nacionalidade_autor" name="nacionalidade_autor" class="form-control" required value="<?= $autor['nacionalidade_autor'] ?>">
    </div>

    <button type="submit" class="btn btn-primary">Salvar Alterações</button>
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
