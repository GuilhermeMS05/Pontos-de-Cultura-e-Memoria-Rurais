<?php
/** 
 * @var MapasCulturais\App $app
 * @var MapasCulturais\Themes\BaseV2\Theme $this
*/

$this->import('
    entity-field
    mc-card
    mc-container
');
?>
<mc-container>
    <mc-card>
        <mc-card__title>
            <h3>Instâncias de Participação</h3>
        </mc-card__title>
        <?php 
        $fields = [
            'conselho_comite_relacionados_cultura', 
            'conselho_comite_relacionados_cultura_se_sim', 
            'avalia_importancia_participacao_instancias',
            'comunidade_participa_foruns_encontros_discutir_cultura',
            'comunidade_participa_foruns_encontros_discutir_cultura_se_sim',
            'principais_discussoes_decisoes_participacao_foruns',
            'acesso_informacoes_sobre_instancias_disponiveis_regiao',
            'acesso_informacoes_sobre_instancias_disponiveis_regiao_se_sim',
            'principais_lacunas_informacao_apoio_esferas',
            'mudanca_significativa_politicas_publicas_cultura',
            'algum_exemplo_participacao_resultou_mudanca',
            'sugestoes_aumentar_participacao',
            'imagina_fortalecimento_instancias_beneficiar_cultura'
        ]; 
        ?>
        <?php foreach ($fields as $field): ?>
            <?php if($this->isEditable() || $entity->$field): ?>
                <p><br></p>
                <entity-field :entity="entity" classes="col-12" prop="<?php echo $field; ?>"></entity-field>
            <?php endif; ?>
        <?php endforeach; ?>
    </mc-card>
</mc-container>