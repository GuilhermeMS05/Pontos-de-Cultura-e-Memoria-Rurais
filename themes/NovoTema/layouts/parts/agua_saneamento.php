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
            <h3>Água e Saneamento</h3>
        </mc-card__title>
        <?php 
        $fields = [
            'principal_fonte_abastecimento', 
            'facilidade_acesso_agua_potavel', 
            'facilidade_acesso_agua_potavel_se_nao',
            'quantidade_agua_disponivel_suficiente',
            'iniciativas_coleta_armazenamento_chuva',
            'iniciativas_coleta_armazenamento_chuva_se_sim',
            'lidar_escassez_agua',
            'saneamento_basico_organizacao',
            'saneamento_basico_organizacao_se_nao',
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