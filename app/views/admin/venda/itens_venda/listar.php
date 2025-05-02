<h2>Itens de Todas as Vendas</h2>

<table class="table table-dark table-striped">
    <thead>
        <tr>
            <th>Cliente</th>
            <th>Data da Venda</th>
            <th>Livro</th>
            <th>Produto</th>
            <th>Quantidade</th>
            <th>Preço Unitário</th>
            <th>Total do Item</th>
        </tr>
    </thead>
    <tbody>
        
    <?php if (!empty($itensVenda)): ?>
        <?php foreach ($itensVenda as $item): ?>
            <tr>
            <?php
                    $caminhoBase = "http://localhost/sistema-LivrariaBooksAndFun/public/uploads/";
                    $caminhoFoto = $caminhoBase . $item['imagem'];  // Acessando a imagem do autor
                
                    if ($item['imagem'] != '') {
                        // Verifica se o arquivo realmente existe no servidor
                        $caminhoFisico = $_SERVER['DOCUMENT_ROOT'] . '/sistema-LivrariaBooksAndFun/public/uploads/' . $item['imagem'];
                        if (file_exists($caminhoFisico)) {
                            $urlFoto = $caminhoFoto;
                        } else {
                            $urlFoto = $caminhoBase . 'semfoto.png'; // Caso a imagem não exista
                        }
                    } else {
                        $urlFoto = $caminhoBase . 'semfoto.png'; // Se não houver imagem no banco de dados
                    }
                    
                    ?>
                    
                <td><?php echo $item['nome_cliente']; ?></td>
                <td><?php echo date('d/m/Y', strtotime($item['data_venda'])); ?></td>
                <td><?php echo $item['titulo_livros']; ?></td>
                <td><img src="<?php echo $urlFoto; ?> " alt="<?php echo $item['imagem']; ?>" width="70"></td>
             
                <td><?php echo $item['quantidade']; ?></td>
                <td>R$ <?php echo number_format($item['preco_unitario'], 2, ',', '.'); ?></td>
                <td>R$ <?php echo number_format($item['valor_total_item'], 2, ',', '.'); ?></td>
            </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr>
            <td colspan="7">Nenhum item de venda encontrado.</td>
        </tr>
    <?php endif; ?>
</tbody>

</table>
<?php var_dump($itensVenda)?>
