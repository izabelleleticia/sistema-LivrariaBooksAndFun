<form method="POST" action="<?php echo BASE_URL; ?>venda/adicionar">
    <div class="form-group">
        <label for="id_cliente">Cliente</label>
        <select name="id_cliente" id="id_cliente" class="form-control" required>
            <option value="" disabled selected>Selecione o Cliente</option>
            <?php foreach ($clientes as $cliente): ?>
                <option value="<?php echo $cliente['id_cliente']; ?>"><?php echo $cliente['nome_cliente']; ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="form-group">
        <label for="data_venda">Data da Venda</label>
        <input type="date" name="data_venda" id="data_venda" class="form-control" required>
    </div>

    <div class="form-group">
        <label for="valor_total">Valor Total</label>
        <input type="text" name="valor_total" id="valor_total" class="form-control" required>
    </div>

    <div class="form-group">
        <label for="forma_pagamento">Forma de Pagamento</label>
        <select name="forma_pagamento" id="forma_pagamento" class="form-control" required>
            <option value="cartao">Cartão</option>
            <option value="boleto">Boleto</option>
            <!-- Adicione mais opções conforme necessário -->
        </select>
    </div>

    <div class="form-group">
        <label for="itens_venda">Itens da Venda</label>
        <div id="itens_venda">
            <div class="item">
                <select name="itens_venda[0][id_produto]" class="form-control" required>
                    <option value="" disabled selected>Selecione o Produto</option>
                    <?php foreach ($dados['livros'] as $livros): ?>
                        <option value="<?php echo $livros['id_livros']; ?>"><?php echo $livros['titulo_livros']; ?></option>
                    <?php endforeach; ?>
                </select>
                <input type="number" name="itens_venda[0][quantidade]" class="form-control" placeholder="Quantidade" required>
                <input type="text" name="itens_venda[0][preco_unitario]" class="form-control" placeholder="Preço Unitário" required>
            </div>
        </div>
    </div>

    <button type="submit" class="btn btn-primary">Adicionar Venda</button>
</form>
