<?php

use DAO\Area;

$descricao = preg_replace('/[^a-zA-Z0-9]*/', '', $_POST['descricao']);
$area = preg_replace('/\D/', '', $_POST['area']);

if (empty($areas = Area::getInstance()->comContagemMelhorias($area, $descricao))) {
    $error_bag = ['code' => 404, 'message' => 'Página não encontrada.'];
    require_once __DIR__ . '/../error.php';
    exit();
}

foreach ($areas as $singleArea) {
    if ($singleArea->id !== (int)$area) {
        require_once __DIR__ . '/../agenda.php';
        exit();
    } else {
        if ($areas[0]->melhorias > 0) {
            $error_bag = ['code' => 401, 'message' => 'Atualização não permitida.'];
            require_once __DIR__ . '/../error.php';
            exit();
        }
    }
}

Area::getInstance()->updateById($area, ['descricao' => $descricao]);

require_once('views/inicio.php');