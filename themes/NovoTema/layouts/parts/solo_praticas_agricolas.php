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
            <h3>Uso do solo e Práticas Agrícolas</h3>
        </mc-card__title>
        <?php 
        $fields = [
            'principal_tipo_cultivo_regiao', 
            'praticas_agricultura_sustentavel_aplicadas', 
            'praticas_agricultura_sustentavel_aplicadas_se_sim',
            'uso_agrotoxicos',
            'uso_agrotoxicos_se_sim',
            'perceber_efeitos_uso_agrotoxico',
            'criacao_gados',
            'criacao_gados_se_sim'
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