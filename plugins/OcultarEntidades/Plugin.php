<?php
namespace plugins\OcultarEntidades;

use MapasCulturais\Entities\Agent;

class Plugin extends \MapasCulturais\Plugin {
    function _init() {
        $this->hook('template.home.sections', function (&$sections) {
            unset($sections['event']);
            unset($sections['project']);
            unset($sections['opportunity']);
        });
    }

    function register() {
        // Registro padrão
    }
}
