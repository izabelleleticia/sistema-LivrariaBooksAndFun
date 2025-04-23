<form class="row g-3" method="POST" action="http://localhost/sistema-LivrariaBooksAndFun/public/cliente/editar/<?php echo $cliente['id_cliente']; ?>">
    <input type="hidden" name="id_cliente" value="<?php echo $cliente['id_cliente']; ?>">

    <div class="col-md-6">
        <label for="nome_cliente" class="form-label">Nome</label>
        <input type="text" class="form-control" id="nome_cliente" name="nome_cliente" required
               value="<?php echo htmlspecialchars($cliente['nome_cliente']); ?>">
    </div>

    <div class="col-md-6">
        <label for="email_cliente" class="form-label">Email</label>
        <input type="email" class="form-control" id="email_cliente" name="email_cliente" required
               value="<?php echo htmlspecialchars($cliente['email_cliente']); ?>">
    </div>

    <div class="col-md-6">
        <label for="telefone_cliente" class="form-label">Telefone</label>
        <input type="text" class="form-control" id="telefone_cliente" name="telefone_cliente" required
               value="<?php echo htmlspecialchars($cliente['telefone_cliente']); ?>">
    </div>

    <div class="col-md-6">
        <label for="endereco_cliente" class="form-label">Endereço</label>
        <input type="text" class="form-control" id="endereco_cliente" name="endereco_cliente" required
               value="<?php echo htmlspecialchars($cliente['endereco_cliente']); ?>">
    </div>

    <div class="col-md-6">
        <label for="cidade_cliente" class="form-label">Cidade</label>
        <input type="text" class="form-control" id="cidade_cliente" name="cidade_cliente" required
               value="<?php echo htmlspecialchars($cliente['cidade_cliente']); ?>">
    </div>

    <div class="col-md-6">
        <label for="estado_cliente" class="form-label">Estado</label>
        <input type="text" class="form-control" id="estado_cliente" name="estado_cliente" required
               value="<?php echo htmlspecialchars($cliente['estado_cliente']); ?>">
    </div>

    <div class="col-12 d-flex justify-content-between mt-3">
        <button type="submit" class="btn btn-primary">Editar</button>
        <button type="reset" class="btn btn-danger">Limpar</button>
    </div>
</form>
