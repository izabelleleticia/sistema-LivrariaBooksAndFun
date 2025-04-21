<a href="http://localhost/sistema-LivrariaBooksAndFun/public/serie/adicionar" class="btn btn-primary">Cadastrar
    Série</a>
<table class="table table-dark table-striped">
    <thead>
        <tr>
            <th scope="col">Imagem</th>
            <th scope="col">Nome</th>
            <th scope="col">Plataforma</th>
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
<script>
    document.addEventListener('DOMContentLoaded', function () {
        function abrirModal(id_serie) {
            // Verifica se o modal já está aberto
            const modalElement = document.getElementById('desativarModal');
            const modal = new bootstrap.Modal(modalElement);

            // Se o modal não estiver visível, o abre
            if (!modalElement.classList.contains('show')) {
                // Definindo o ID do livro/serviço para o campo oculto
                document.getElementById('idParaDesativar').value = id_serie;
                modal.show();
            }
        }

        document.getElementById('btnDesativar').addEventListener('click', function () {
            const idSerie = document.getElementById('idParaDesativar').value;
            if (idSerie) {
                console.log("Id recuperado: " + idSerie);
                desativarLivro(idSerie);
            }
        });

        function desativarLivro(idSerie) {
            fetch(`http://localhost/sistema-LivrariaBooksAndFun/public/serie/desativar/${idSerie}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                }
            })
                .then(response => {
                    if (!response.ok) {
                        return response.json().then(data => {
                            throw new Error(`Erro HTTP: ${response.status}, ${data.mensagem}`);
                        });
                    }
                    return response.json();
                })
                .then(data => {
                    // Resposta com sucesso
                    console.log(data.mensagem); // Log da resposta
                    const modal = bootstrap.Modal.getInstance(document.getElementById('desativarModal'));
                    modal.hide();
                    location.reload();  // Recarrega a página após sucesso
                })
                .catch(error => {
                    alert("Erro na requisição. Verifique a conexão com o servidor: " + error.message);
                });
        }

        // Expor a função abrirModal para que seja usada no HTML ou em outros scripts
        window.abrirModal = abrirModal;
    });

</script>