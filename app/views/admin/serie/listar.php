<a href="http://localhost/sistema-LivrariaBooksAndFun/public/serie/adicionar" class="btn btn-primary">Cadastrar
    Série</a>
<table class="table table-dark table-striped">
    <thead>
        <tr>
            <th scope="col">Imagem</th>

            <th scope="col">Nome</th>
            <th scope="col">Plataforma</th>
            <th scope="col">Ano de Lançamento</th>
            <th scope="col">Genêro</th>
            <th scope="col">Sinopse</th>
            <th scope="col">Plataforma de Streaming</th>
            <th>Editar</th>
            <th>Desativar</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($serie as $linha): ?>
        <tr>
            <td>
                <?php
                    $caminhoBase = "http://localhost/sistema-LivrariaBooksAndFun/public/uploads/";
                    $caminhoFoto = $caminhoBase . $linha['imagem'];

                    if (!empty($linha['imagem']) && @getimagesize($caminhoFoto)) {
                        $urlFoto = $caminhoFoto;
                    } else {
                        $urlFoto = $caminhoBase . 'semfoto.png';
                    }
                ?>
                <div class="img-tbl">
                    <img src="<?php echo $urlFoto; ?>" class="img-thumbnail" alt="<?php echo $linha['imagem']; ?>">
                </div>
            </td>
            <td><?php echo $linha['nome_serie']; ?></td>
            <td><?php echo $linha['plataforma']; ?></td>
            <td><?php echo $linha['ano_lancamento']; ?></td>
            <td><?php echo $linha['genero']; ?></td>
            <td><?php echo $linha['sinopse']; ?></td>
            <td><?php echo $linha['plataforma']; ?></td> <!-- Se tiver esse campo no banco -->

            <td>
                <a href="http://localhost/sistema-LivrariaBooksAndFun/public/serie/editar/<?php echo $linha['id_serie']; ?>"
                   class="btn btn-primary">
                    <i class="bi bi-pencil-fill"></i> Editar
                </a>
            </td>

            <td>
                <a href="#" class="btn btn-danger" title="Desativar"
                   onclick="abrirModal(<?php echo $linha['id_serie']; ?>); return false;">
                    <i class="bi bi-trash-fill"></i>
                </a>
            </td>
        </tr>
    <?php endforeach ?>
</tbody>

</table>