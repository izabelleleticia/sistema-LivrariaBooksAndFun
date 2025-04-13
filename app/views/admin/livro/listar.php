<a href="http://localhost/sistema-LivrariaBooksAndFun/public/livro/adicionar" class="btn btn-primary">Cadastrar
    Servico</a>

<table class="table table-dark table-striped">
    <thead>
        <tr>
            <th scope="col">Foto</th>
            <th scope="col">Título</th>
            <th scope="col">Descrição</th>
            <th scope="col">Ano Publicação</th>
            <th scope="col">Preço</th>
            <th scope="col">Estoque</th>
            <th scope="col">Especialidade</th>
            <th>Editar</th>
            <th>Desativar</th>
        </tr>
    </thead>
    <tbody>

        <?php
        foreach ($livro as $linha): ?>
            <tr>
                <td scope="col">
                    <?php

                    $caminhoBase = "http://localhost/sistema-LivrariaBooksAndFun/public/uploads/";
                    $caminhoFoto = $caminhoBase . $linha['imagem'];

                    if ($linha['imagem'] != '') {
                        // Verifica se a imagem existe na URL
                        if (@getimagesize($caminhoFoto)) {
                            $urlFoto = $caminhoFoto;
                        } else {
                            // Caso não exista, utiliza a imagem padrão
                            $urlFoto = $caminhoBase . 'semfoto.png';
                        }
                    } else {
                        // Se não houver foto no banco de dados, utiliza a imagem padrão
                        $urlFoto = $caminhoBase . 'semfoto.png';
                    }


                    //$urlFoto =  $linha['foto_servico'] != '' && file_exists($caminhoFoto)
                    //? $caminhoFoto : $caminhoBase . 'semfoto.png';
                
                    ?>
                    <div class="img-tbl">
                        <img src="<?php echo $urlFoto; ?> " class="img-thumbnail" alt="<?php echo $linha['imagem']; ?>">
                    </div>
                </td>
                <td scope="col"><?php echo $linha['titulo_livros']; ?></td>
                <td scope="col"><?php echo $linha['descricao_genero']; ?></td>
                <td scope="col"><?php echo $linha['ano_publicacao']; ?></td>
                <td scope="col"><?php echo $linha['preco']; ?></td>
                <td scope="col"><?php echo $linha['estoque']; ?></td>
                <td scope="col"><?php echo $linha['nome_editora']; ?></td>
                <!-- <?php var_dump($linha); ?> -->
                <td>
                    <a href="http://localhost/sistema-LivrariaBooksAndFun/public/livro/editar/<?php echo $linha['id_livros'];?>"
                        class="btn btn-primary">
                        <i class="bi bi-pencil-fill"></i> Editar
                    </a>
                    
                </td>


                <td>
                    <a href="#" type="button" class="btn btn-danger" title="Desativar"
                        onclick="abrirModal(<?php echo $linha['id_livros']; ?>); return false;">
                        <i class="bi bi-trash-fill"></i>
                    </a>
                </td>
            </tr>

        <?php endforeach ?>

    </tbody>
</table>



<!-- Modal -->
<div class="modal fade" id="desativarModal" tabindex="-1" aria-labelledby="desativarModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="desativarModalLabel">Desativar Serviço</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h2>Deseja realmente desativar o serviço?</h2>
                <input type="hidden" id="idParaDesativar" value="">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" id="btnDesativar">Desativar</button>
            </div>
        </div>
    </div>
</div>

<script>document.addEventListener('DOMContentLoaded', function () {

        function abrirModal(id_servico) {
            // Verifica se o modal já está aberto
            const modalElement = document.getElementById('desativarModal');
            const modal = new bootstrap.Modal(modalElement);

            // Se o modal não estiver visível, o abre
            if (!modalElement.classList.contains('show')) {
                document.getElementById('idParaDesativar').value = id_servico;
                modal.show();
            }
        }

        document.getElementById('btnDesativar').addEventListener('click', function () {
            const idServico = document.getElementById('idParaDesativar').value;
            if (idServico) {
                console.log("Id recuperado: " + idServico);
                desativarServico(idServico);
            }
        });

        function desativarServico(idServico) {
            fetch(`http://localhost/sistema/public/servicos/desativar/${idServico}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                }
            })
                .then(response => {
                    if (!response.ok) {
                        throw new Error(`Erro HTTP: ${response.status}`);
                    }
                    return response.json();
                })
                .then(data => {
                    // Resposta com sucesso
                    const modal = bootstrap.Modal.getInstance(document.getElementById('desativarModal'));
                    modal.hide();
                    location.reload();
                })
                .catch(error => {
                    alert("Erro na requisição. Verifique a conexão com o servidor");
                })
        }

        window.abrirModal = abrirModal;
    });
</script>