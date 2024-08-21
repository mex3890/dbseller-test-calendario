<?php

use Application\Helpers\Response;
use Application\Helpers\Str;
use DAO\Area;

if (empty($description = $_POST['descricao'])) {
    Response::fail('Erro de validação.', [
        'errors' => [
            'descricao' => 'A descrição é obrigatória.'
        ]
    ]);
}

if (empty($area = $_POST['area'])) {
    Response::fail('Erro de validação', [
        'errors' => [
            'area' => 'A área é obrigatória.'
        ]
    ]);
}

if (!empty($searchArea = Area::getInstance()->filtrarPorDescricao($description))) {
    if (!is_array($searchArea)) {
        $searchArea = [$searchArea->id];
    }

    foreach ($searchArea as $singleArea) {
        if ($singleArea !== (int)$area) {
            Response::fail('Erro de validação.', [
                'errors' => ['descricao' => 'Uma área com esta descrição já existe.'],
            ]);
        }
    }
}

if (Area::getInstance()->updateById($area, ['descricao' => $description])) {
    Response::success('Área atualizada com sucesso!');
}

error_log('Fail on try update area, ' . json_encode(['description' => $description, 'area_id' => $area]));

Response::fail('Erro interno ao criar área.', [], 500);