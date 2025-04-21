<form class="row g-3" method="POST" enctype="multipart/form-data" action="http://localhost/sistema-LivrariaBooksAndFun/public/serie/adicionar/">

<div class="form-group">
    <label for="nome_serie" class="form-label">Nome</label>
    <input type="text" class="form-control" id="nome_serie" name="nome_serie" required>
</div>

<div class="form-group">
    <label for="plataforma" class="form-label">Plataforma</label>
    <input type="text" class="form-control" id="plataforma" name="plataforma" required>
</div>

<div class="mb-3">
    <label for="ano_lancamento" class="form-label">Ano de lançamento</label>
    <input type="number" class="form-control" id="ano_lancamento" name="ano_lancamento" required>  
</div>

<div class="form-group">
    <label for="genero" class="form-label">Gênero</label>
    <input type="text" class="form-control" id="genero" name="genero" required>
</div>

<div class="form-group">
    <label for="sinopse" class="form-label">Sinopse</label>
    <textarea class="form-control" id="sinopse" name="sinopse" rows="3" required></textarea>
</div>    

<div class="form-group">
    <label for="imagem" class="form-label">Imagem</label>
    <input type="file" class="form-control" id="imagem" name="imagem">
</div>

<div class="form-group mt-3">
    <button type="submit" class="btn btn-primary">Adicionar Série</button>
</div>

</form>
