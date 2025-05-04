<h2><?= $titulo ?></h2>

<?php if (empty($livros)): ?>
    <p>Todos os livros estão com estoque adequado.</p>
<?php else: ?>
    <table class="table table-dark table-striped">
        <thead>
            <tr>
                <th scope="col">Capa</th>
                <th scope="col">Título</th>
                <th scope="col">Estoque</th>
                <th scope="col">Preço</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($livros as $livro): ?>
                <tr>
                    <td>
                        <?php
                        $caminhoBase = "http://localhost/sistema-LivrariaBooksAndFun/public/uploads/";
                        $nomeImagem = $livro['imagem'] ?? '';
                        $caminhoImagem = $caminhoBase . ($nomeImagem !== '' ? $nomeImagem : 'semfoto.png');

                        // Verifica se o arquivo existe fisicamente
                        $caminhoFisico = $_SERVER['DOCUMENT_ROOT'] . '/sistema-LivrariaBooksAndFun/public/uploads/' . $nomeImagem;
                        if (!file_exists($caminhoFisico) || $nomeImagem === '') {
                            $caminhoImagem = $caminhoBase . 'semfoto.png';
                        }
                        ?>
                        <img src="<?= $caminhoImagem ?>" class="img-thumbnail" alt="Capa do livro" width="60">
                    </td>
                    <td><?= htmlspecialchars($livro['titulo_livros']) ?></td>
                    <td><?= $livro['estoque'] ?></td>
                    <td>R$ <?= number_format($livro['preco'], 2, ',', '.') ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>
