<form method="POST" enctype="multipart/form-data">
    
    <div class="form-group">
        <label for="titulo_livros" class="form-label">Título</label>
        <input type="text" class="form-control" id="titulo_livros" name="titulo_livros" required>
    </div>
    
    <div class="form-group">
        <label for="descricao_genero" class="form-label">Descrição / Gênero</label>
        <input type="text" class="form-control" id="descricao_genero" name="descricao_genero" required>
    </div>
    
    <div class="form-group">
        <label for="ano_publicacao" class="form-label">Ano de Publicação</label>
        <input type="number" class="form-control" id="ano_publicacao" name="ano_publicacao" required>
    </div>
    
    <div class="form-group">
        <label for="preco" class="form-label">Preço</label>
        <input type="number" step="0.01" class="form-control" id="preco" name="preco" required>
    </div>
    <div class="form-group">
        <label for="nome_autor" class="form-label">Autor</label>
        <input type="text" class="form-control" id="nome_autor" name="nome_autor" required>
    </div>
    <!-- <div class="form-group">
    <!-- <?php var_dump($dados);?>
    <label for="nome_autor" class="form-label">Autor</label>
    <select class="form-select" id="nome_autor" name="nome_autor" required>
        <?php foreach ($dados['autores'] as $autor): ?>
            <option value="<?php echo $autor['nome_autor']; ?>">
                <?php echo $autor['nome_autor']; ?>
            </option>
        <?php endforeach; ?> -->
    </select>
</div> -->

    <div class="form-group">
        <label for="estoque" class="form-label">Estoque</label>
        <input type="number" class="form-control" id="estoque" name="estoque" required>
    </div>
    
    <div class="form-group">
        <label for="nome_editora" class="form-label">Editora</label>
        <select class="form-select" id="nome_editora" name="nome_editora" required>
            <?php foreach ($dados['editoras'] as $editora): ?>
                <option value="<?php echo $editora['nome_editora']; ?>">
                    <?php echo $editora['nome_editora']; ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>
    
    <div class="form-group">
        <label for="imagem" class="form-label">Imagem</label>
        <input type="file" class="form-control" id="imagem" name="imagem">
    </div>

    <button type="submit" class="btn btn-primary">Adicionar Livro</button>
</form>
