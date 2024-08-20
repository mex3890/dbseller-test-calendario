<?php

use Application\Helpers\Url;

if (!($path = Url::getAdditionalPath())) {
    require_once('views/inicio.php');
    exit();
}

if (!file_exists($path = __DIR__ . "/views/$path.php")) {
    $error_bag = ['code' => 404, 'message' => 'Página não encontrada.'];
    require_once(__DIR__ . '/views/error.php');
    exit();
}

require_once($path);
?>