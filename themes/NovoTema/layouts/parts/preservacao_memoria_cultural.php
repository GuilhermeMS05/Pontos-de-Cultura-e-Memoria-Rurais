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
            <h3>Preservação da Memória Cultural</h3>
        </mc-card__title>
        <?php 
        $fields = [
            'atividades_pre_memo_cult', 
            'atividades_pre_memo_cult_se_sim', 
            'acervo_ou_documentacao',
            'acervo_ou_documentacao_descreva',
            'eventos_ou_atividades',
            'criacao_preservacao_novas_manifestacoes_culturais',
            'criacao_preservacao_novas_manifestacoes_culturais_se_sim'
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