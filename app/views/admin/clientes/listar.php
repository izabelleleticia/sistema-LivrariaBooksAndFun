<a href="http://localhost/sistema-LivrariaBooksAndFun/public/cliente/adicionar" class="btn btn-primary mb-3">Cadastrar Cliente</a>

<table class="table table-dark table-striped">
    <thead>
        <tr>
            <th scope="col">Nome</th>
            <th scope="col">Email</th>
            <th scope="col">Telefone</th>
            <th scope="col">Cidade</th>
            <th scope="col">Estado</th>
            <th>Editar</th>
            <th>Desativar</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($dados['clientes'] as $cliente): ?>
            <tr>
                <td scope="col"><?= $cliente['nome_cliente']; ?></td>
                <td scope="col"><?= $cliente['email_cliente']; ?></td>
                <td scope="col"><?= $cliente['telefone_cliente']; ?></td>
                <td scope="col"><?= $cliente['cidade_cliente']; ?></td>
                <td scope="col"><?= $cliente['estado_cliente']; ?></td>
                <td>
                    <a href="http://localhost/sistema-LivrariaBooksAndFun/public/cliente/editar/<?= $cliente['id_cliente']; ?>" class="btn btn-primary">
                        <i class="bi bi-pencil-fill"></i> Editar
                    </a>
                </td>
                <td>
                    <a href="#" class="btn btn-danger" title="Desativar"
                       onclick="abrirModal(<?= $cliente['id_cliente']; ?>); return false;">
                        <i class="bi bi-trash-fill"></i>
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<!-- Modal de confirmação -->
<div class="modal fade" id="desativarModal" tabindex="-1" aria-labelledby="desativarModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Desativar Cliente</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
            </div>
            <div class="modal-body">
                <h5>Deseja realmente desativar este cliente?</h5>
                <input type="hidden" id="idParaDesativar" value="">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-danger" id="btnDesativar">Desativar</button>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        function abrirModal(idCliente) {
            const modalElement = document.getElementById('desativarModal');
            const modal = new bootstrap.Modal(modalElement);
            document.getElementById('idParaDesativar').value = idCliente;
            modal.show();
        }

        document.getElementById('btnDesativar').addEventListener('click', function () {
            const id = document.getElementById('idParaDesativar').value;
            if (id) {
                desativarCliente(id);
            }
        });

        function desativarCliente(id) {
            fetch(`http://localhost/sistema-LivrariaBooksAndFun/public/cliente/desativar/${id}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                }
            })
            .then(response => {
                if (!response.ok) throw new Error("Erro ao desativar cliente");
                return response.json();
            })
            .then(data => {
                const modal = bootstrap.Modal.getInstance(document.getElementById('desativarModal'));
                modal.hide();
                location.reload();
            })
            .catch(error => {
                alert("Erro: " + error.message);
            });
        }

        window.abrirModal = abrirModal;
    });
</script>
