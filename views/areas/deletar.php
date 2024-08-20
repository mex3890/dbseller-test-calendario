<?php

use Application\Helpers\Response;
use DAO\Area;

if (empty($area = $_POST['area'])) {
    Response::fail('Erro de validação.', [
        'errors' => [
            'area' => 'O campo área é obrigatório.'
        ]
    ]);
}

if (!is_int($area) && !is_string($area)) {
    Response::fail('Erro de validação.', [
        'errors' => [
            'area' => 'O campo área deve ser um inteiro.'
        ]
    ]);
}


if (Area::getInstance()->deleteById($area)) {
    Response::success('Área deletada com sucesso!');
}

Response::fail('Erro interno ao deletar área', [], 500);