<form method="POST" enctype="multipart/form-data">
    
    <div class="form-group">
        <label for="titulo_livros" class="form-label">Título</label>
        <input type="text" class="form-control" id="titulo_livros" name="titulo_livros" required>
    </div>
    
    <div class="mb-3">
        <label for="descricao_genero" class="form-label">Gênero</label>
        <select class="form-select" id="descricao_genero" name="descricao_genero" required>
        <?php foreach ($dados['generos'] as $linha): ?> 
    <option value="<?php echo $linha['descricao_genero']; ?>"
        <?php echo ($linha['descricao_genero'] == $dados['descricao_genero']) ? 'selected' : ''; ?>>
        <?php echo $linha['descricao_genero']; ?>
    </option>
<?php endforeach; ?>

        </select>
    </div>
    
    <div class="form-group">
        <label for="ano_publicacao" class="form-label">Ano de Publicação</label>
        <input type="number" class="form-control" id="ano_publicacao" name="ano_publicacao" required>
    </div>
    
    <div class="form-group">
        <label for="preco" class="form-label">Preço</label>
        <input type="number" step="0.01" class="form-control" id="preco" name="preco" required>
    </div>
   
    <div class="mb-3">
        <label for="nome_autor" class="form-label">Autor</label>
        <select class="form-select" id="nome_autor" name="nome_autor" required>
        <?php foreach ($dados['autores'] as $linha): ?> 
    <option value="<?php echo $linha['nome_autor']; ?>"
        <?php echo ($linha['nome_autor'] == $dados['nome_autor']) ? 'selected' : ''; ?>>
        <?php echo $linha['nome_autor']; ?>
    </option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="form-group">
        <label for="estoque" class="form-label">Estoque</label>
        <input type="number" class="form-control" id="estoque" name="estoque" required>
    </div>
    
    <div class="form-group">
        <label for="nome_editora" class="form-label">Editora</label>
        <select class="form-select" id="nome_editora" name="nome_editora" required>
        <?php foreach ($dados['editoras'] as $linha): ?> 
    <option value="<?php echo $linha['nome_editora']; ?>"
        <?php echo ($linha['nome_editora'] == $dados['nome_editora']) ? 'selected' : ''; ?>>
        <?php echo $linha['nome_editora']; ?>
    </option>
<?php endforeach; ?>

        </select>
    </div>
    <div class="col-md-6">
    <label for="nome_serie" class="form-label">Série</label>
    <select class="form-select" id="nome_serie" name="nome_serie">
        <option value="" <?php echo empty($dados['nome_serie']) ? 'selected' : ''; ?>>Sem série</option>
        <?php foreach ($dados['series'] as $linha): ?>
            <option
                <?php echo ($linha['nome_serie'] == $dados['nome_serie']) ? 'selected' : ''; ?>>
                <?php echo $linha['nome_serie']; ?>
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
