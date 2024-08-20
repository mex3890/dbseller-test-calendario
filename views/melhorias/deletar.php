<?php

use Application\Helpers\Response;
use DAO\Melhoria;

if (empty($melhoria = $_POST['melhoria'])) {
    Response::fail('Erro de validação.', [
        'errors' => [
            'melhoria' => 'O campo melhoria é obrigatório.'
        ]
    ]);
}

if (!is_int($melhoria) && !is_string($melhoria)) {
    Response::fail('Erro de validação.', [
        'errors' => [
            'melhoria' => 'O campo melhoria deve ser um inteiro.'
        ]
    ]);
}

if (Melhoria::getInstance()->deleteById($melhoria)) {
    Response::success('Melhoria deletada com sucesso!');
}

error_log('Fail on try delete melhoria, ' . json_encode(['melhoria_id' => $melhoria]));

Response::fail('Erro interno ao deletar melhoria', [], 500);