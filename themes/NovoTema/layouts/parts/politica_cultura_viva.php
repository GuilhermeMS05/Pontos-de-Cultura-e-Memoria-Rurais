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
            <h3>Política Nacional Cultura Viva</h3>
        </mc-card__title>
        <?php 
        $fields = [
            'politica_nacional_cultura_viva_organizacao',
            'pontos_cultura_organizacao',
            'certificada_organizacao',
            'gostaria_ser_certificada_organizacao',
            'estagio_desenvolvimento_organizacao'
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