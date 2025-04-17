<form class="row g-3" method="POST" enctype="multipart/form-data" action="http://localhost/sistema-LivrariaBooksAndFun/public/serie/editar/<?php echo $dadosSerie['id_serie'];?>">

<input type="hidden" name="nome_serie" value="<?php echo $dadosSerie['nome_serie']; ?>">

<div class="row">
    <!-- IMAGEM -->
    <div class="col-md-3">
        <?php
        $fotoPath = !empty($dadosSerie['imagem']) 
                   ? BASE_URL . 'uploads/' . $dadosSerie['imagem']
                   : BASE_URL . 'assets/img/sem-foto.jpg';
        ?>
        <img id="preview" class="rounded-2" src="<?= htmlspecialchars($fotoPath) ?>" 
             alt="Capa da série" 
             style="margin-left:10px; width:350px; height:320px; object-fit:cover; cursor:pointer;"
             title="Clique para alterar a capa">
        <input type="file" name="imagem" id="imagem" style="display:none;" accept="image/*">
        <input type="hidden" name="foto_atual" value="<?= htmlspecialchars($dadosSerie['imagem'] ?? '') ?>">
    </div>

    <div class="col-md-5">
        <!-- Nome -->
        <div class="mb-3">
            <label for="nome_serie" class="form-label">Nome</label>
            <input type="text" class="form-control" id="nome_serie" name="nome_serie" required 
                   value="<?php echo $dadosSerie['nome_serie']; ?>">
        </div>

        <!-- Plataforma -->
        <div class="mb-3">
            <label for="plataforma" class="form-label">Plataforma</label>
            <select class="form-select" id="plataforma" name="plataforma" required>
                <?php foreach ($dados['plataforma'] as $linha): ?> 
                    <option value="<?php echo $linha['nome_streaming']; ?>" 
                        <?php echo ($linha['nome_streaming'] == $dadosSerie['plataforma']) ? 'selected' : ''; ?>>
                        <?php echo $linha['nome_streaming']; ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-3">
        <label for="ano_lancamento" class="form-label">Ano de Publicação</label>
        <input type="number" min="1000" max="2099" class="form-control" id="ano_lancamento" name="ano_lancamento" 
               required value="<?php echo $dadosSerie['ano_lancamento'] ?? ''; ?>">
    </div>

        <!-- Gênero -->
        <div class="mb-3">
            <label for="genero" class="form-label">Gênero</label>
            <select class="form-select" id="genero" name="genero" required>
                <?php foreach ($dados['generos'] as $linha): ?> 
                    <option value="<?php echo $linha['genero']; ?>" 
                        <?php echo ($linha['genero'] == $dadosSerie['genero']) ? 'selected' : ''; ?>>
                        <?php echo $linha['genero']; ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <!-- Sinopse -->
        <div class="mb-3">
            <label for="sinopse" class="form-label">Sinopse</label>
            <input type="text" class="form-control" id="sinopse" name="sinopse" required 
            value="<?php echo $dadosSerie['sinopse']; ?>">
                   
          
            </select>
        </div>
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
