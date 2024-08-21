<?php

use DAO\Area;

$areas = Area::getInstance()->order('descricao')->getAll();
$meses = [];

for ($m = 1; $m <= 12; $m++) {
    $meses[] = (object)[
        'id' => $m,
        'descricao' => date('F', mktime(0, 0, 0, $m)),
    ];
}

?>
<section id="filter_section">
    <h1>Filtro de tarefas</h1>
    <div class="container" id="agenda">
        <form class="col-sm-12 col-md-6">
            <div class="form-row">
                <div class="form-group col-sm-12">
                    <label for="area">Áreas</label>
                    <select class="form-control" id="area">
                        <option value="0">Selecione</option>
                        <?php foreach ($areas as $area) : ?>
                            <option value="<?php echo $area->id; ?>"><?php echo $area->descricao; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <small id="areaHelp" class="form-text text-muted">Area de negócio da tarefa.</small>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-sm-12">
                    <label for="mes_inicio">Período</label>
                    <select class="form-control" id="mes_inicio">
                        <option value="0">Selecione</option>
                        <?php foreach ($meses as $mes) : ?>
                            <option value="<?php echo $mes->id; ?>"><?php echo $mes->descricao; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group col-sm-12 col-md-2">
                    <div>&nbsp;</div>
                    <div class="separador-texto-combos">à</div>
                </div>
                <div class="form-group col-sm-12">
                    <label for="mes_fim">&nbsp;</label>
                    <select class="form-control" id="mes_fim">
                        <option value="0">Selecione</option>
                        <?php foreach ($meses as $mes) : ?>
                            <option value="<?php echo $mes->id; ?>"><?php echo $mes->descricao; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <button type="button" id="btn_buscar" class="btn btn-primary mt-5">Buscar</button>
        </form>
    </div>
</section>
<script src="../assets/js/search.js" type="module"></script>
