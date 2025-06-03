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
            <h3>Diagnóstico - Equipes da Organização</h3>
        </mc-card__title>
        <?php 
        $fields = [
            'orientacao_sexual_equipe_organizacao',
            'orientacao_sexual_equipe_organizacao_outra',
            'identidade_genero_equipe_organizacao',
            'identidade_genero_equipe_organizacao_outra',
            'raca_cor_etnia_equipe_organizacao',
            'raca_cor_etnia_equipe_organizacao_outro',
            'deficiencia_equipe_organizacao',
            'quais_pessoas_participam_equipe_organizacao',
            'quais_pessoas_participam_equipe_organizacao_outras',
            'quais_vinculos_trabalho_equipe_organizacao'
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