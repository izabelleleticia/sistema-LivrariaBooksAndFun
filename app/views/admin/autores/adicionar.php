<div class="container mt-4">
    <h2>Cadastrar Autor</h2>

    <?php if (!empty($mensagem)): ?>
        <div class="alert alert-<?= $tipo_msg ?>">
            <?= $mensagem ?>
        </div>
    <?php endif; ?>

    <form action="<?= BASE_URL ?>autor/adicionar" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="nome_autor">Nome do Autor</label>
            <input type="text" class="form-control" name="nome_autor" id="nome_autor" required>
        </div>

        <div class="form-group">
            <label for="nacionalidade_autor">Nacionalidade</label>
            <input type="text" class="form-control" name="nacionalidade_autor" id="nacionalidade_autor">
        </div>

        <div class="form-group">
            <label for="imagem">Foto do Autor</label>
            <input type="file" class="form-control-file" name="imagem" id="imagem" accept="image/*">
        </div>

        <button type="submit" class="btn btn-success mt-3">Salvar</button>
        <a href="<?= BASE_URL ?>autor/listar" class="btn btn-secondary mt-3">Cancelar</a>
    </form>
</div>
