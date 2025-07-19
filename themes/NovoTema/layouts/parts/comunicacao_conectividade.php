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
            <h3>Comunicação e Conectividade</h3>
        </mc-card__title>
        <?php 
        $fields = [
            'acoes_produtos_comunicacao_organizacao', 
            'como_divulga_atividades', 
            'tipo_conectividade',
            'como_conecta',
            'como_conecta_outras',
            'interesse_fazer_parte_grupo_organizacao'
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