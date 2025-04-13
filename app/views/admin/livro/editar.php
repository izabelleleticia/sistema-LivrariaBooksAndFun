<form class="row g-3" method="POST" enctype="multipart/form-data" action="<?php echo BASE_URL; ?>livro/editar/<?php echo $dadosLivro['id_livros']; ?>">
 <?php var_dump($dadosLivro);?>
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
         style="width:100%; height:150px; object-fit:cover; cursor:pointer;"
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

            <div class="col-12">
                <label for="descricao_genero" class="form-label">Gênero</label>
                <textarea class="form-control" id="descricao_genero" name="descricao_genero" rows="3" required>
                    <?php echo trim($dadosLivro['descricao_genero']);?>
                </textarea>
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

        <div class="row">
            <div class="col-md-4">
                <label for="alt_tipo" class="form-label">Editora</label>
                <input type="text" class="form-control" id="alt_tipo" name="alt_tipo" required 
                       value="<?php echo $dadosLivro['nome_editora']; ?>">
            </div>

            <!-- <div class="col-md-4">
                <label for="id_especialidade" class="form-label">Especialidade</label>
                <select class="form-select" id="id_especialidade" name="id_especialidade" required>
                    <option value="" disabled selected>Selecione uma especialidade</option>
                    <?php foreach ($especialidade as $linha): ?>
                        <option value="<?php echo $linha['id_especialidade']; ?>"
                            <?php echo ($linha['id_especialidade'] == $dadosServico['id_especialidade']) ? 'selected' : ''; ?>>
                            <?php echo $linha['nome_especialidade']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="col-md-4">
                <label for="status_servico" class="form-label">Status</label>
                <select class="form-select" id="status_servico" name="status_servico" required>
                    <option value="<?php echo $dadosServico['status_servico']; ?>" selected>
                        <?php echo $dadosServico['status_servico']; ?>
                    </option>
                    <option value="ATIVO">ATIVO</option>
                    <option value="INATIVO">INATIVO</option>
                    <option value="DESATIVADO">DESATIVADO</option>
                </select>
            </div>
        </div> -->

        <div class="col-md-12" style="display: flex; justify-content: space-between; margin-top: 20px;">
            <button type="submit" class="btn btn-primary">Editar Serviço</button>
            <button type="reset" class="btn btn-danger">Limpar</button>
        </div>
    </div>
</form>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const previewImg = document.getElementById('preview');
    const fileInput = document.getElementById('foto_servico');

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
