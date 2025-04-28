<body class="Pesquisa">

    <div class="pesquisa-container">
        <h1>Resultados da Pesquisa</h1>

        <?php if (!empty($resultados)): ?>
            <ul>
                <?php foreach ($resultados as $livro): ?>
                    <div class="pesquisa">
                        <h2><?php echo $livro['titulo_livros']; ?></h2>
                        <div>
                        <a href="livro/detalhe/<?php echo $livro['id_livros']; ?>">
                        <img src="<?php echo BASE_URL . 'uploads/' . $livro['imagem']; ?>" alt="Imagem do livro">

                        </div>
                        <h3>Autor: <?php echo isset($livro['nome_autor']) ? $livro['nome_autor'] : 'Autor não encontrado'; ?></h3>
                        <p><?php echo $livro['descricao_livro'] ?: 'Descrição não disponível'; ?></p>
                        <a href="livro/detalhe/<?php echo $livro['id_livros']; ?>">
                        Ver detalhes</a>
                    </div>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p>Nenhum resultado encontrado para a sua pesquisa.</p>
        <?php endif; ?>
    </div>

</body>
</html>