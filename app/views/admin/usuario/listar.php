<h2><?= $titulo ?></h2>

<?php if (!empty($_SESSION['mensagem'])): ?>
    <div class="alert alert-<?= $_SESSION['tipo-msg'] ?>">
        <?= $_SESSION['mensagem'] ?>
    </div>
    <?php unset($_SESSION['mensagem'], $_SESSION['tipo-msg']); ?>
<?php endif; ?>

<a href="<?= BASE_URL ?>usuarios/adicionar" class="btn btn-primary mb-3">Novo Usuário</a>

<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>Foto</th>

            <th>Nome</th>
            <th>Email</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($usuarios as $usuario): ?>
            <tr>
                <td>
                    <?php
                    $caminhoBase = "http://localhost/sistema-LivrariaBooksAndFun/public/uploads/";  // Base da URL
                    $imagem = $usuario['imagem'] ?? 'semfoto.png';  // Verifica se existe uma imagem, senão usa 'semfoto.png'

                    // Caso a imagem não tenha o caminho 'usuarios/', vamos adicionar a pasta automaticamente
                    if (strpos($imagem, 'usuarios/') === false) {
                        $imagem = 'usuarios/' . $imagem;  // Adiciona a pasta 'usuarios/' apenas se não estiver presente
                    }

                    $urlImagem = $caminhoBase . $imagem;  // Cria a URL completa para a imagem

                    $caminhoFisico = $_SERVER['DOCUMENT_ROOT'] . '/sistema-LivrariaBooksAndFun/public/uploads/' . $imagem;  // Caminho físico completo

                    // Verifica se o arquivo existe
                    if (!file_exists($caminhoFisico) || empty($imagem)) {
                        $urlImagem = $caminhoBase . 'semfoto.png';  // Se não existir, usa uma imagem padrão
                    }
                    ?>
                    <!-- <?php var_dump($urlImagem);?> -->
                    <img src="<?= $urlImagem ?>" alt="Foto do usuário" width="50" height="50" class="rounded-circle">

                 


                </td>

                <td><?= htmlspecialchars($usuario['nome_usuario']) ?></td>
                <td><?= htmlspecialchars($usuario['email_usuario']) ?></td>
                <td>
                    <a href="<?= BASE_URL ?>usuarios/editar/<?= $usuario['id_usuario'] ?>" class="btn btn-warning btn-sm">Editar</a>
                    <a href="<?= BASE_URL ?>usuarios/excluir/<?= $usuario['id_usuario'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza que deseja excluir este usuário?')">Excluir</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>