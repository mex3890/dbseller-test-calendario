<div id="error_page">
    <div>
        <h1><?= isset($error_bag['code']) ? $error_bag['code'] : 404; ?></h1>
        <a href="/">Início</a>
    </div>
    <h3><?= isset($error_bag['message']) ? $error_bag['message'] : 'Página não encontrada.'; ?></h3>
</div>