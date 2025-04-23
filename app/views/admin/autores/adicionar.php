<!-- admin/autores/adicionar.php -->
<form method="POST" action="<?= BASE_URL ?>autor/adicionar">
    <h2>Adicionar Autor</h2>

    <!-- Mensagem de erro ou sucesso -->
    <?php if (isset($dados['mensagem'])): ?>
        <div class="alert <?= isset($dados['tipo-msg']) && $dados['tipo-msg'] == 'sucesso' ? 'alert-success' : 'alert-danger' ?>">
            <?= $dados['mensagem'] ?>
        </div>
    <?php endif; ?>
    

    <div class="form-group">
        <label for="nome_autor">Nome do Autor</label>
        <input type="text" id="nome_autor" name="nome_autor" class="form-control" required value="<?= isset($dadosAutor['nome_autor']) ? $dadosAutor['nome_autor'] : '' ?>">
    </div>

    <div class="form-group">
        <label for="nacionalidade_autor">Nacionalidade do Autor</label>
        <input type="text" id="nacionalidade_autor" name="nacionalidade_autor" class="form-control" required value="<?= isset($dadosAutor['nacionalidade_autor']) ? $dadosAutor['nacionalidade_autor'] : '' ?>">
    </div>

    <div class="form-group">
        <label for="imagem" class="form-label">Imagem</label>
        <input type="file" class="form-control" id="imagem" name="imagem">
    </div>
    
    <button type="submit" class="btn btn-primary">Adicionar Autor</button>
</form>
