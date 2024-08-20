<?php

use Application\Helpers\Response;
use Application\Helpers\Str;
use DAO\Melhoria;

if (empty($area = $_POST['area'])) {
    Response::fail('Erro de validação', [
        'errors' => [
            'area' => 'A área é obrigatória.'
        ]
    ]);
}

if (empty($tarefa = $_POST['tarefa'])) {
    Response::fail('Erro de validação', [
        'errors' => [
            'tarefa' => 'A tarefa é obrigatória.'
        ]
    ]);
}

if (empty($descricao = $_POST['descricao'])) {
    Response::fail('Erro de validação.', [
        'errors' => [
            'descricao' => 'A descrição é obrigatória.'
        ]
    ]);
}

if (empty($_POST['gravidade']) && empty($_POST['urgencia']) && empty($_POST['tendencia'])) {
    Response::fail('Erro de validação.', [
        'errors' => [
            'gravidade' => 'Pelo menos um dos campos de GUT deve ser selecionado.'
        ]
    ]);
}

if (!empty($_POST['prazo_acordado'])) {
    if (($date = DateTime::createFromFormat('Y-m-d', $_POST['prazo_acordado'])) === false) {
        Response::fail('Erro de validação.', [
            'errors' => [
                'prazo_acordado' => 'O formato do prazo acordado deve ser (Y-m-d).'
            ]
        ]);
    }

    if ($date < new DateTime()) {
        Response::fail('Erro de validação.', [
            'errors' => [
                'prazo_acordado' => 'O prazo acordado não pode ser uma data passada.'
            ]
        ]);
    }

    if ($date > DateTime::createFromFormat('Y-m-d', date('Y') . '-12-31')) {
        Response::fail('Erro de validação.', [
            'errors' => [
                'prazo_acordado' => 'O prazo acordado deve ser uma data no ano atual.'
            ]
        ]);
    }
} else {
    Response::fail('Erro de validação.', [
        'errors' => [
            'prazo_acordado' => 'O prazo acordado é obrigatório.'
        ]
    ]);
}

if (!empty($_POST['prazo_legal'])) {
    if (($date = DateTime::createFromFormat('Y-m-d', $_POST['prazo_legal'])) === false) {
        Response::fail('Erro de validação.', [
            'errors' => [
                'prazo_legal' => 'O formato do prazo legal deve ser (Y-m-d).'
            ]
        ]);
    }

    if ($date < new DateTime()) {
        Response::fail('Erro de validação.', [
            'errors' => [
                'prazo_legal' => 'O prazo legal não pode ser uma data passada.'
            ]
        ]);
    }

    if ($date > DateTime::createFromFormat('Y-m-d', date('Y') . '-12-31')) {
        Response::fail('Erro de validação.', [
            'errors' => [
                'prazo_legal' => 'O prazo legal deve ser uma data no ano atual.'
            ]
        ]);
    }
}

if (Melhoria::getInstance()->create($melhoria = [
    'descricao' => $descricao,
    'area' => $area,
    'tarefa' => $tarefa,
    'prazo_acordado' => empty($_POST['prazo_acordado']) ? null : $_POST['prazo_acordado'],
    'prazo_legal' => empty($_POST['prazo_legal']) ? null : $_POST['prazo_legal'],
    'gravidade' => empty($_POST['gravidade']) ? null : $_POST['gravidade'],
    'urgencia' => empty($_POST['urgencia']) ? null : $_POST['urgencia'],
    'tendencia' => empty($_POST['tendencia']) ? null : $_POST['tendencia'],
])) {
    Response::success('Melhoria criada com sucesso!', [], 201);
}

error_log('Fail on try create melhoria, ' . json_encode($melhoria));

Response::fail('Erro interno ao criar melhoria.', [], 500);
