<h1><?= $titulo ?></h1>

<form method="POST" action="">
  <div class="mb-3">
    <label for="nome" class="form-label">Nome</label>
    <input type="text" class="form-control" id="nome" name="nome_cliente" required>
  </div>

  <div class="mb-3">
    <label for="email" class="form-label">E-mail</label>
    <input type="email" class="form-control" id="email" name="email_cliente" required>
  </div>

  <div class="mb-3">
    <label for="telefone" class="form-label">Telefone</label>
    <input type="text" class="form-control" id="telefone" name="telefone_cliente" required>
  </div>

  <div class="mb-3">
    <label for="endereco" class="form-label">Endereço</label>
    <input type="text" class="form-control" id="endereco" name="endereco_cliente" required>
  </div>

  <div class="mb-3">
    <label for="cidade" class="form-label">Cidade</label>
    <input type="text" class="form-control" id="cidade" name="cidade_cliente" required>
  </div>

  <div class="mb-3">
    <label for="estado" class="form-label">Estado</label>
    <input type="text" class="form-control" id="estado" name="estado_cliente" required>
  </div>

  <button type="submit" class="btn btn-success">Cadastrar Cliente</button>
</form>
