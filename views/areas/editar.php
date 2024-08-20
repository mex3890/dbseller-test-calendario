<?php

use DAO\Area;

if (!isset($_GET['area']) || ($area = Area::getInstance()->filtrarPorId($_GET['area'])) === false) {
    $error_bag = ['code' => 404, 'message' => 'Página não encontrada.'];
    require_once(__DIR__ . '/../error.php');
    exit();
}
?>
<section>
    <nav class="table-header-index">
        <h1>Editar Área</h1>
        <a class="btn btn-secondary mt-3 px-5" href="?path=agenda">Voltar</a>
    </nav>
    <form id="area_update_form">
        <div class="form-group">
            <label for="descricao">Descrição</label>
            <input type="text" class="form-control" id="descricao" aria-describedby="descricaoHelp"
                   placeholder="Descrição..." name="descricao" required value="<?= $area->descricao;?>">
            <small id="descricaoHelp" class="form-text text-muted">Entre com a descrição da área.</small>
        </div>
        <input hidden type="text" value="<?= $_GET['area']; ?>" id="area" name="area">
        <button type="button" id="area_update" class="btn btn-primary">Atualizar</button>
    </form>
</section>
<script>

</script>