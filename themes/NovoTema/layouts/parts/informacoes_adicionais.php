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
            <h3>Informações adicionais</h3>
        </mc-card__title>
        <?php $fields = ['quais_acoes_foram_desenvolvidos', 'quais_acoes_foram_desenvolvidos_outros', 'impactos_mudancas_climaticas', 'impactos_mudancas_climaticas_outras', 'quantas_pessoas_beneficiadas_por_mes']; ?>
        
        <?php foreach ($fields as $field): ?>
            <?php if($this->isEditable() || $entity->$field): ?>
                <p><br></p>
                <entity-field :entity="entity" classes="col-12" prop="<?php echo $field; ?>"></entity-field>
            <?php endif; ?>
        <?php endforeach; ?>
    </mc-card>
</mc-container>