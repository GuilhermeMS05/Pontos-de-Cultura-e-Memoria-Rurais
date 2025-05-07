<?php
use MapasCulturais\App;
use MapasCulturais\i;

$app = App::i();
?>

<div class="home-header">
    <h1 class="home-header__title"><?= $app->siteName ?></h1>
    <p class="home-header__description">
        <?= i::__("Bem-vindo ao Mapa Cultural da Minha Cidade! Aqui você encontra pessoas, locais e atividades culturais.") ?>
    </p>
</div>
