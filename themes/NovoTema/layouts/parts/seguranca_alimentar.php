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
            <h3>Segurança Alimentar</h3>
        </mc-card__title>
        <?php 
        $fields = [
            'possui_espaco_producao_alimentos', 
            'possui_espaco_producao_alimentos_se_sim', 
            'praticas_agroecologia_utiliza_producao',
            'participou_iniciativa_comercializacao_alimentos_governo',
            'participou_iniciativa_comercializacao_alimentos_governo_se_sim',
            'canais_vendas_produtos',
            'sente_suficientes_garantir_renda_justo',
            'hortas_comunitarias',
            'hortas_comunitarias_se_sim',
            'hortas_comunitarias_se_sim_segundo',
            'feiras_livres',
            'feiras_livres_se_sim',
            'iniciativas_colaborativas_producao_consumo',
            'iniciativas_colaborativas_producao_consumo_se_sim',
            'principais_desafios_seguranca_alimentar',
            'apoio_recurso_melhorar_producao_comercializacao'
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