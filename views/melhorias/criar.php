<?php
if (empty($_GET['area'])) {
    $error_bag = ['code' => 404, 'message' => 'Página não encontrada.'];
    require_once(__DIR__ . '/../error.php');
    exit();
}
?>

<section class="form">
    <nav class="table-header-index">
        <h1>Criar Melhoria</h1>
        <a class="btn btn-secondary mt-3 px-5" href="?path=agenda">Voltar</a>
    </nav>
    <form id="create_area_form">
        <div class="form-group gap-2 d-flex flex-column">
            <label for="descricao">Descrição</label>
            <input type="text" class="form-control field" id="descricao" aria-describedby="descricao_help"
                   placeholder="Entre com a descrição..." required>
            <small id="descricao_help" class="form-text text-muted">Entre com a descrição da nova área. Este valor deve
                ser único.</small>
        </div>
        <button id="area_create" type="button" class="btn btn-primary mt-3 px-5">Salvar</button>
    </form>
</section>