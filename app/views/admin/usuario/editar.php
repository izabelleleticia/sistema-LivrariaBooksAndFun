<h2><?= $titulo ?></h2>

<form action="<?= BASE_URL ?>usuarios/editar/<?= $usuario['id_usuario'] ?>" method="post">
    <div class="mb-3">
        <label for="nome" class="form-label">Nome:</label>
        <input type="text" name="nome" id="nome" value="<?= htmlspecialchars($usuario['nome_usuario']) ?>" class="form-control" required>
    </div>

    <div class="mb-3">
        <label for="email" class="form-label">Email:</label>
        <input type="email" name="email" id="email" value="<?= htmlspecialchars($usuario['email_usuario']) ?>" class="form-control" required>
    </div>

    <div class="mb-3">
        <label for="senha" class="form-label">Nova Senha (opcional):</label>
        <input type="password" name="senha" id="senha" class="form-control">
    </div>

    <button type="submit" class="btn btn-primary">Atualizar</button>
</form>
