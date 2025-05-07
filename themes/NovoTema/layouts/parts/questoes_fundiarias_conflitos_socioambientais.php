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
            <h3>Questões Fundiárias e Conflitos Socioambientais</h3>
        </mc-card__title>
        <?php 
        $fields = [
            'conflitos_relacionados_terra', 
            'conflitos_relacionados_terra_se_sim', 
            'poder_publico_lidado_conflitos',
            'enfrentou_conflitos_vizinhos_empresas',
            'enfrentou_conflitos_vizinhos_empresas_se_sim',
            'apoio_resistencia_grandes_empreendimentos',
            'apoio_resistencia_grandes_empreendimentos_se_sim'
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