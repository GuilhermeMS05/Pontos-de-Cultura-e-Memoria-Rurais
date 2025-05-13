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
            <h3>Acesso à Água</h3>
        </mc-card__title>
        <?php 
        $fields = [
            'principal_fonte_abastecimento', 
            'facilidade_acesso_agua_potavel', 
            'facilidade_acesso_agua_potavel_se_nao',
            'quantidade_agua_disponivel_suficiente',
            'iniciativas_coleta_armazenamento_chuva',
            'iniciativas_coleta_armazenamento_chuva_se_sim',
            'lidar_escassez_agua'
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