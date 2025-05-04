<a href="http://localhost/sistema-LivrariaBooksAndFun/public/autor/adicionar" class="btn btn-primary">Cadastrar Autor</a>
<table class="table table-striped">
    <thead>
        <tr>
            <th>#</th>
            <th>Foto</th>
            <th>Nome</th>
            <th>Nacionalidade</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($dados['autores'] as $autor): ?>
            <tr>
                <td scope="col">
                    <?php
                    $caminhoBase = "http://localhost/sistema-LivrariaBooksAndFun/public/uploads/";
                    $caminhoFoto = $caminhoBase . $autor['imagem'];  // Acessando a imagem do autor
                
                    if ($autor['imagem'] != '') {
                        // Verifica se o arquivo realmente existe no servidor
                        $caminhoFisico = $_SERVER['DOCUMENT_ROOT'] . '/sistema-LivrariaBooksAndFun/public/uploads/' . $autor['imagem'];
                        if (file_exists($caminhoFisico)) {
                            $urlFoto = $caminhoFoto;
                        } else {
                            $urlFoto = $caminhoBase . 'semfoto.png'; // Caso a imagem não exista
                        }
                    } else {
                        $urlFoto = $caminhoBase . 'semfoto.png'; // Se não houver imagem no banco de dados
                    }
                    ?>

                    <div class="img-tbl">
                        <img src="<?php echo $urlFoto; ?>" class="img-thumbnail" alt="Foto do autor">
                    </div>
                    <!-- Exibe o valor da URL da foto para cada autor -->
                    <?php var_dump(value: $urlFoto); ?>
                </td>
                <td><?= htmlspecialchars($autor['nome_autor']) ?></td>
                <td><?= htmlspecialchars($autor['nacionalidade_autor']) ?></td>
                <td>
                    <a href="<?= BASE_URL ?>autor/editar/<?= $autor['id_autor'] ?>"
                        class="btn btn-warning btn-sm">Editar</a>
                        <button class="btn btn-danger btn-sm"
    onclick="abrirModalDesativar(<?= $autor['id_autor'] ?>)">Desativar</button>

                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<!-- Modal -->
<div class="modal fade" id="modalDesativar" tabindex="-1" aria-labelledby="modalDesativarLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalDesativarLabel">Confirmar Desativação</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
      </div>
      <div class="modal-body">
        Tem certeza que deseja desativar este autor?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <a id="btnConfirmarDesativar" class="btn btn-danger">Desativar</a>
      </div>
    </div>
  </div>
</div>
<script>
function abrirModalDesativar(id) {
    // Atualiza o botão com o link de desativação
    document.getElementById('btnConfirmarDesativar').href = "<?= BASE_URL ?>autor/desativar/" + id;

    // Abre o modal (requer Bootstrap 5+)
    var modal = new bootstrap.Modal(document.getElementById('modalDesativar'));
    modal.show();
}
</script>
