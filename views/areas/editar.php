<?php

use DAO\Area;

if (!isset($_GET['area']) || ($area = Area::getInstance()->filtrarPorId($_GET['area'])) === false) {
    $error_bag = ['code' => 404, 'message' => 'Página não encontrada.'];
    require_once(__DIR__ . '/../error.php');
    exit();
}
?>
<section id="area_update">
    <form action="?path=areas/atualizar" method="POST">
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