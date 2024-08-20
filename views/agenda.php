<?php

use Application\Services\AgendaService;
use DAO\Area;
use DAO\Gravidade;
use DAO\Tendencia;
use DAO\Urgencia;

$mInicial = 1;
$mFinal = 12;

if (!empty($_GET['meses'])) {
    if (strpos($_GET['meses'], '-') !== false) {
        list($mInicial, $mFinal) = explode('-', $_GET['meses']);
    } else {
        $mInicial = $mFinal = $_GET['meses'];
    }
}

if ($mInicial > $mFinal) {
    require_once('views/inicio.php');
    exit();
}

if (!empty($_GET['area'])) {
    $areas = Area::getInstance()->comContagemMelhorias($_GET['area']);
} else {
    $areas = Area::getInstance()->comContagemMelhorias();
}

$gravidadesAll = Gravidade::getInstance()->order('id')->getAll();
$urgenciasAll = Urgencia::getInstance()->order('id')->getAll();
$tendenciasAll = Tendencia::getInstance()->order('id')->getAll();
$urgencias = Urgencia::getInstance()->order('id', 'desc')->getAll(3);
$melhorias = AgendaService::mountMelhorias();
?>
<section id="agenda_section">
    <nav class="table-header-index">
        <h1>Index de Áreas</h1>
        <a class="btn btn-primary px-3" href="?path=areas/criar">Criar Novo</a>
    </nav>
    <div class="container-fluid">
        <table class="table tableFixHead main-table" id="main-table">
            <thead class="thead-dark">
            <tr>
                <th scope="col"><a href="?path=agenda">#Áreas</a></th>
                <?php for ($i = $mInicial; $i <= $mFinal; $i++) { ?>
                    <th scope="col">
                        <a href="?path=agenda&meses=<?= $i; ?>">
                            <?php echo date("F", mktime(0, 0, 0, $i)); ?>
                        </a>
                    </th>
                <?php } ?>
                <th scope="col">Ações</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($areas as $area) : ?>
                <tr>
                    <th scope="row"><a
                                href="?path=agenda&area=<?php echo $area->id; ?>"><?php echo $area->descricao; ?></a>
                    </th>
                    <?php for ($i = $mInicial; $i <= $mFinal; $i++) : ?>
                        <td>
                            <table id="melhorias" class="table">
                                <thead>
                                </thead>
                                <tbody>
                                <tr>
                                    <?php foreach ($urgenciasAll as $urgencia) : ?>
                                        <?php $melhoriasEncontradas = !empty($melhorias[$area->id][$i][$urgencia->id]) ? $melhorias[$area->id][$i][$urgencia->id] : null; ?>
                                        <?php if (!empty($melhoriasEncontradas)) : ?>
                                            <?php foreach ($melhoriasEncontradas as $melhoria) : ?>
                                                <td class="table-<?php echo $urgencia->id == 5 ? 'primary' : ($urgencia->id == 4 ? 'danger' : 'warning'); ?>">
                                                    <div class="wrapper-melhoria"
                                                         id="wrapper_melhoria_<?php echo "{$area->id}_{$i}_{$melhoria->id}" ?>">
                                                        <div class="card" style="width: 18rem;">
                                                            <div class="card-body">
                                                                <h5 class="card-title"><?= $melhoria->tarefa; ?></h5>
                                                                <p class="card-text"><?php echo $melhoria->descricao ?></p>
                                                                <button class="btn btn-primary modal-melhoria"
                                                                        type="button" data-bs-toggle="modal"
                                                                        data-bs-target="#melhoria_<?php echo $melhoria->id ?>">
                                                                    <i class="fas fa-plus"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                        <?php include __DIR__ . '/components/modal.php' ?>
                                                    </div>
                                                </td>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </tr>
                                </tbody>
                            </table>
                        </td>
                    <?php endfor; ?>
                    <td class="d-flex justify-content-center align-items-center gap-2 <?= $area->melhorias === 0 ? 'empty' : 'non-empty'; ?>">
                        <?php if ($area->melhorias === 0) { ?>
                            <a class="btn btn-primary px-3 d-flex justify-content-center align-items-center" style="width: 60px; padding: 10px 0"
                               href="?path=areas/editar&area=<?= $area->id; ?>">
                                <i class='bx bxs-edit-alt h5' style="padding: 0;margin: 0"></i>
                            </a>
                            <button class="btn btn-danger px-3 area-delete d-flex justify-content-center align-items-center" style="width: 60px; padding: 10px 0"
                                    data-area="<?= $area->id ?>">
                                <i class='bx bxs-trash h5' style="padding: 0;margin: 0"></i>
                            </button>
                        <?php } ?>
                        <a class="btn btn-warning px-3 d-flex justify-content-center align-items-center" style="width: 60px; padding: 10px 0"
                           href="?path=areas/editar&area=<?= $area->id; ?>">
                            <i class='bx bx-paperclip h5' style="padding: 0;margin: 0"></i>
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</section>
