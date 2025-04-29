<a href="http://localhost/sistema-LivrariaBooksAndFun/public/venda/adicionar" class="btn btn-primary">Cadastrar Venda</a>

<table class="table table-dark table-striped">
    <thead>
        <tr>
            <th scope="col">Cliente</th>
            <th scope="col">Data da Venda</th>
            <th scope="col">Valor Total</th>
            <th scope="col">Forma de Pagamento</th>
            <th>Editar</th>
            <th>Desativar</th>
        </tr>
    </thead>
    <tbody>

        <?php
        foreach ($vendas as $linha): ?>
            <tr>
                <td scope="col"><?php echo $linha['nome_cliente']; ?></td>
                <td scope="col"><?php echo $linha['data_venda']; ?></td>
                <td scope="col"><?php echo $linha['valor_total']; ?></td>
                <td scope="col"><?php echo $linha['forma_pagamento']; ?></td>
                <td>
                    <a href="<?php echo 'http://localhost/sistema-LivrariaBooksAndFun/public/venda/editar/' . $linha['id_venda']; ?>"
                        class="btn btn-primary">
                        <i class="bi bi-pencil-fill"></i> Editar
                    </a>
                </td>

                <td>
                    <a href="#" type="button" class="btn btn-danger" title="Desativar"
                        onclick="abrirModal(<?php echo $linha['id_venda']; ?>); return false;">
                        <i class="bi bi-trash-fill"></i>
                    </a>
                </td>
            </tr>

        <?php endforeach ?>

    </tbody>
</table>
