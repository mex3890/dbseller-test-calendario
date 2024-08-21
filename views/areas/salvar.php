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

if (Str::hasSpecialCharacter($description)) {
    Response::fail('Erro de validação.', [
        'errors' => [
            'descricao' => 'A descrição não pode ter caracteres especiais.'
        ]
    ]);
}

if (!empty(Area::getInstance()->filtrarPorDescricao($description))) {
    Response::fail('Erro de validação.', [
        'errors' => [
            'descricao' => 'Uma área com esta descrição já existe.'
        ]
    ]);
}

if (Area::getInstance()->create(['descricao' => $description])) {
    Response::success('Área criada com sucesso!', [], 201);
}

error_log('Fail on try create melhoria, ' . json_encode(['description' => $description]));

Response::fail('Erro interno ao criar área.', [], 500);
