<section id="area_create">
    <form action="?path=areas/salvar" method="POST">
        <div class="form-group">
            <label for="descricao">Descrição</label>
            <input type="text" class="form-control" id="descricao" aria-describedby="descricaoHelp"
                   placeholder="Descrição..." name="descricao" required>
            <small id="descricaoHelp" class="form-text text-muted">Entre com a descrição da área.</small>
        </div>
        <input hidden type="text" value="<?= $_GET['area']; ?>" name="area">
        <button type="submit" class="btn btn-primary">Atualizar</button>
    </form>
</section>