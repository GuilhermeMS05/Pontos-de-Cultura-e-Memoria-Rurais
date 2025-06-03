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
            <h3>Diagnóstico - Representantes da Organização</h3>
        </mc-card__title>
        <?php 
        $fields = [
            'representante_legal_organizacao', 
            'funcao_exerce_organizacao',
            'funcao_exerce_organizacao_outra',
            'orientacao_sexual_organizacao',
            'orientacao_sexual_organizacao_outra',
            'identidade_genero_organizacao',
            'identidade_genero_organizacao_outra',
            'idade_organizacao',
            'raca_cor_etnia_organizacao',
            'raca_cor_etnia_organizacao_outro',
            'vinculo_trabalho_organizacao',
            'vinculo_trabalho_remunerado_organizacao',
            'trabalha_voluntariamente_organizacao',
            'politica_nacional_cultura_viva_organizacao',
            'pontos_cultura_organizacao',
            'acesso_internet_organizacao',
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