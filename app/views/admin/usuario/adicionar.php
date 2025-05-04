<h2><?= $titulo ?></h2>

<form action="<?= BASE_URL ?>usuarios/adicionar" method="post" enctype="multipart/form-data">
    <div class="mb-3">
        <label for="imagem" class="form-label">Foto do Usuário</label>
        <input type="file" name="imagem" id="imagem" class="form-control">
    </div>
    <div class="mb-3">
        <label for="nome_usuario" class="form-label">Nome:</label>
        <input type="text" name="nome_usuario" id="nome_usuario" class="form-control" required>
    </div>

    <div class="mb-3">
        <label for="email_usuario" class="form-label">Email:</label>
        <input type="email" name="email_usuario" id="email" class="form-control" required>
    </div>

    <div class="mb-3">
        <label for="senha_usuario" class="form-label">Senha:</label>
        <input type="password" name="senha_usuario" id="senha" class="form-control" required>
    </div>

    <button type="submit" class="btn btn-success">Salvar</button>
</form>
