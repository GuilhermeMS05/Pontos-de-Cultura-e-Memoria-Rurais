<?php
/**
 * @var MapasCulturais\App $app
 * @var MapasCulturais\Themes\BaseV2\Theme $this
 */

use MapasCulturais\i;

$this->import('
    mc-header-menu
    mc-header-menu-user
    mc-icon
    mc-messages 
    theme-logo 
');
?>
<?php $this->applyTemplateHook('main-header', 'before') ?>
<header class="main-header" id="main-header">
    <?php $this->applyTemplateHook('main-header', 'begin') ?>

    <div class="main-header__content">

        <?php $this->applyTemplateHook('mc-header-menu', 'before') ?>
        <mc-header-menu>

            <!-- Logo -->
            <template #logo>
                <theme-logo href="<?= $app->createUrl('site', 'index') ?>"></theme-logo>
            </template>
            <!-- Menu principal -->
            <template #default>
                <?php $this->applyTemplateHook('mc-header-menu', 'begin') ?>
                
                <?php $this->applyTemplateHook('mc-header-menu-home', 'before') ?>
                <li>
                    <?php $this->applyTemplateHook('mc-header-menu-home', 'begin') ?>
                    <a href="<?= $app->createUrl('site', 'index') ?>" class="mc-header-menu--item home">
                        <span class="icon"> <mc-icon name="home"></mc-icon> </span>
                        <p class="label"> <?php i::_e('Página Inicial') ?> </p>
                    </a>
                    <?php $this->applyTemplateHook('mc-header-menu-home', 'end') ?>
                </li>
                <?php $this->applyTemplateHook('mc-header-menu-home', 'after') ?>

                <?php $this->applyTemplateHook('mc-header-menu-agent', 'before') ?>
                <li v-if="global.enabledEntities.agents">
                    <?php $this->applyTemplateHook('mc-header-menu-agent', 'begin') ?>
                    <a href="<?= $app->createUrl('search', 'agents') ?>" class="mc-header-menu--item agent">
                        <span class="icon"> <mc-icon name="agent-2"> </span>
                        <p class="label"> <?php i::_e('Organizações e Coletivos') ?> </p>
                    </a>
                    <?php $this->applyTemplateHook('mc-header-menu-agent', 'end') ?>
                </li>
                <?php $this->applyTemplateHook('mc-header-menu-agent', 'after') ?>

                <?php $this->applyTemplateHook('mc-header-menu', 'before') ?>
                <li>
                    <?php $this->applyTemplateHook('mc-header-menu', 'begin') ?>
                    <a href="https://mapas.redenacionaldepontosdeculturaememoriarurais.com/agentes/#map" class="mc-header-menu--item opportunity">
                        <span class="icon"> <mc-icon name="map"></mc-icon> </span>
                        <p class="label"> <?php i::_e('Mapa') ?> </p>
                    </a>
                </li>
                <?php $this->applyTemplateHook('mc-header-menu', 'after') ?>

                <?php $this->applyTemplateHook('mc-header-menu', 'before') ?>
                <li>
                    <?php $this->applyTemplateHook('mc-header-menu', 'begin') ?>
                    <a href="https://www.redenacionaldepontosdeculturaememoriarurais.com/" target="_blank" class="mc-header-menu--item space">
                        <span class="icon"> <mc-icon name="spaces"></mc-icon> </span>
                        <p class="label"> <?php i::_e('Site da Rede') ?> </p>
                    </a>
                </li>
                <?php $this->applyTemplateHook('mc-header-menu', 'after') ?>
                
                <?php $this->applyTemplateHook('mc-header-menu', 'end') ?>
            </template>

        </mc-header-menu>
        <?php $this->applyTemplateHook('mc-header-menu', 'after') ?>

        <div class="main-header__buttons">
            <?php $this->applyTemplateHook('mc-header-menu-user', 'before') ?>
            <?php if ($app->user->is('guest')): ?>
                <!-- Botão login -->
                <a href="<?= $app->createUrl('auth') ?>?redirectTo=<?=$_SERVER['REQUEST_URI']?>" class="logIn">
                    <?php i::_e('Entrar') ?>
                </a>
            <?php else: ?>
                <!-- Menu do usuário -->
                <mc-header-menu-user></mc-header-menu-user>
            <?php endif; ?>
            <?php $this->applyTemplateHook('mc-header-menu-user', 'after') ?>
        </div>

    </div>

    <?php $this->applyTemplateHook('main-header', 'end') ?>
</header>
<?php $this->applyTemplateHook('main-header', 'after') ?>

<mc-messages></mc-messages>