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
            <h3>Qualidade da Água</h3>
        </mc-card__title>
        <?php 
        $fields = [
            'agua_comunidade_frequentemente_testada', 
            'agua_comunidade_frequentemente_testada_se_sim', 
            'problemas_saude_devido_qualidade_agua',
            'campanhas_conscientizacao_importancia_qualidade_agua',
            'campanhas_conscientizacao_importancia_qualidade_agua_se_sim',
            'medidas_tomadas_organizacao_qualidade_agua'
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