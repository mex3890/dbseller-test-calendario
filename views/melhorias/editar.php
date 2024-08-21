<?php

use DAO\Gravidade;
use DAO\Melhoria;
use DAO\Tendencia;
use DAO\Urgencia;

if (empty($_GET['melhoria']) || empty($melhoria = Melhoria::getInstance()->filtrarPorId($_GET['melhoria']))) {
    $error_bag = ['code' => 404, 'message' => 'Página não encontrada.'];
    require_once(__DIR__ . '/../error.php');
    exit();
}

?>
<section class="form">
    <nav class="table-header-index">
        <h1>Editar Melhoria</h1>
        <a class="btn btn-secondary mt-3 px-5" href="?path=agenda&meses=<?= date('m') ?>-12">Voltar</a>
    </nav>
    <form id="update_area_form">
        <input hidden value="<?= $melhoria->area; ?>" type="text" name="area" readonly class="field">
        <input hidden value="<?= $melhoria->id; ?>" type="text" name="melhoria" readonly class="field">
        <div class="mb-3">
            <label for="tarefa" class="form-label">Tarefa</label>
            <textarea required class="form-control field" name="tarefa" id="tarefa" aria-describedby="tarefa_help"
                      style="resize: none"><?= $melhoria->tarefa; ?></textarea>
            <div id="tarefa_help" class="form-text">Entre com o título da nova tarefa.</div>
        </div>

        <div class="mb-3">
            <label for="descricao" class="form-label">Descrição</label>
            <textarea class="form-control field" id="descricao" aria-describedby="descricao_help"
                      style="resize: none" required name="descricao"><?= $melhoria->descricao; ?></textarea>
            <div id="descricao_help" class="form-text">Entre com a descrição da nova tarefa.</div>
        </div>
        <div class="mb-3">
            <div class="form-check">
                <input class="form-check-input field" type="checkbox"
                    <?= $melhoria->demanda_legal ? 'checked' : ''; ?> id="is_legal" name="is_legal">
                <label class="form-check-label" for="is_legal">Demanda Legal</label>
            </div>
        </div>
        <div class="mb-3">
            <label for="prazo_acordado" class="form-label">Prazo Acordado</label>
            <input max="<?= date('Y') . '-12-31'; ?>" min="<?= date('Y-m-d'); ?>" type="date" class="field form-control"
                   value="<?= $melhoria->prazo_acordado; ?>" id="prazo_acordado" aria-describedby="prazo_acordado_help"
                   name="prazo_acordado" required>
            <div id="prazo_acordado_help" class="form-text">Entre com o prazo acordado para a tarefa.</div>
        </div>
        <div class="mb-3">
            <label for="prazo_legal" class="form-label">Prazo Legal</label>
            <input name="prazo_legal" disabled max="<?= date('Y') . '-12-31'; ?>" min="<?= date('Y-m-d'); ?>"
                   type="date" value="<?= empty($melhoria->prazo_legal) ? $melhoria->prazo_legal : ''; ?>"
                   class="form-control field" id="prazo_legal" aria-describedby="prazo_legal_help">
            <div id="prazo_legal_help" class="form-text">Entre com o prazo legal para a tarefa.</div>
        </div>
        <div class="mb-3">
            <label for="gravidade" class="form-label">Gravidade</label>
            <select class="form-select field" aria-label="gravidade_help" id="gravidade" name="gravidade">
                <option selected value="0">Nenhuma selecionado</option>
                <?php foreach (Gravidade::getInstance()->getAll() as $gravidade) { ?>
                    <option value="<?= $gravidade->id; ?>" <?= $melhoria->gravidade === $gravidade->id ? 'selected' : ''; ?>><?= $gravidade->descricao; ?></option>
                <?php } ?>
            </select>
            <div id="gravidade_help" class="form-text">Entre com a gravidade da tarefa.</div>
        </div>

        <div class="mb-3">
            <label for="urgencia" class="form-label">Urgência</label>
            <select class="form-select field" aria-label="urgencia_help" id="urgencia" name="urgencia">
                <option selected value="0">Nenhuma selecionado</option>
                <?php foreach (Urgencia::getInstance()->getAll() as $urgencia) { ?>
                    <option <?= $melhoria->urgencia === $urgencia->id ? 'selected' : ''; ?>
                            value="<?= $urgencia->id; ?>"><?= $urgencia->descricao; ?></option>
                <?php } ?>
            </select>
            <div id="gravidade_help" class="form-text">Entre com a urgência da tarefa.</div>
        </div>

        <div class="mb-3">
            <label for="tendencia" class="form-label">Tendência</label>
            <select class="form-select field" aria-label="tendencia_help" id="tendencia" name="tendencia">
                <option selected value="0">Nenhuma selecionado</option>
                <?php foreach (Tendencia::getInstance()->getAll() as $tendencia) { ?>
                    <option <?= $melhoria->tendencia === $tendencia->id ? 'selected' : ''; ?>
                            value="<?= $tendencia->id; ?>"><?= $tendencia->descricao; ?></option>
                <?php } ?>
            </select>
            <div id="gravidade_help" class="form-text">Entre com a tendência da tarefa.</div>
        </div>
        <button id="melhoria_update" type="button" class="btn btn-primary mt-3 px-5">Salvar</button>
    </form>
</section>