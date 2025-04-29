<form class="row g-3" method="POST" enctype="multipart/form-data" action="http://localhost/sistema-LivrariaBooksAndFun/public/autor/editar/<?php echo $autor['id_autor']; ?>">
    <!-- <?php var_dump($autor['imagem']); ?> -->
    <input type="hidden" name="id_autor" value="<?php echo $autor['id_autor']; ?>">

    <div class="row">
        <!-- FOTO -->
        <div class="col-md-3">
            <?php
            $fotoPath = !empty($autor['imagem'])
                        ? BASE_URL . 'uploads/' . $autor['imagem']
                        : BASE_URL . 'assets/img/sem-foto.jpg';
            ?>
            <img id="preview" class="rounded-2" src="<?= htmlspecialchars($fotoPath) ?>"
                alt="Foto do autor"
                style="margin-left:50px; width:250px; height:320px; object-fit:cover; cursor:pointer;"
                title="Clique para alterar a foto">
            <input type="file" name="imagem" id="imagem" style="display:none;" accept="image/*">
            <input type="hidden" name="foto_atual" value="<?= htmlspecialchars($autor['imagem'] ?? '') ?>">
        </div>

        <!-- COLUNA 1 -->
        <div class="col-md-3 ms-0 ps-2">
            <div class="mb-1">
                <label for="nome_autor" class="form-label">Nome do Autor</label>
                <input type="text" class="form-control" id="nome_autor" name="nome_autor" required
                    value="<?php echo $autor['nome_autor']; ?>">
            </div>
            <div class="mb-1">
                <label for="nacionalidade_autor" class="form-label">Nacionalidade</label>
                <input type="text" class="form-control" id="nacionalidade_autor" name="nacionalidade_autor" 
                    value="<?php echo $autor['nacionalidade_autor']; ?>">
            </div>
        </div>

        <!-- COLUNA 2
        <div class="col-md-5">
            <div class="mb-3">
                <label for="data_nascimento" class="form-label">Data de Nascimento</label>
                <input type="date" class="form-control" id="data_nascimento" name="data_nascimento" 
                    value="<?php echo $autor['data_nascimento'] ?? ''; ?>">
            </div> -->

            <div class="mb-3">
                <label for="biografia" class="form-label">Biografia</label>
                <textarea class="form-control" id="biografia" name="biografia" rows="4"><?php echo $autor['biografia']; ?></textarea>
            </div>
        </div>
    </div>

    <!-- BOTÕES -->
    <div class="col-12 d-flex justify-content-between mt-3">
        <button type="submit" class="btn btn-primary">Salvar Alterações</button>
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
