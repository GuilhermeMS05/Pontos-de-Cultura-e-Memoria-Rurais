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
            <h3>Diagnóstico - Organização</h3>
        </mc-card__title>
        <?php 
        $fields = [
            'quantos_habitantes_organizacao',
            'quantos_anos_atua_organizacao',
            'certificada_organizacao',
            'gostaria_ser_certificada_organizacao',
            'estagio_desenvolvimento_organizacao',
            'programa_faz_parte_organizacao',
            'programa_faz_parte_organizacao_outro',
            'escala_atuacao_organizacao',
            'territorio_povos_comunidades_organizacao',
            'territorio_povos_comunidades_organizacao_outro',
            'infraestrutura_presente_organizacao',
            'infraestrutura_presente_organizacao_outra',
            'linguagens_artisticas_organizacao',
            'atuacao_tematica_organizacao',
            'atuacao_tematica_secundarias_organizacao',
            'publico_atendido_organizacao',
            'realiza_atividades_organizacao',
            'realiza_atividades_organizacao_outro',
            'sede_propria_condicao_organizacao',
            'sede_propria_condicao_organizacao_outro',
            'sede_propria_dificuldades_organizacao',
            'sede_propria_espacos_organizacao',
            'sede_propria_espacos_organizacao_outro',
            'itens_presentes_organizacao',
            'itens_presentes_organizacao_outro',
            'origem_recursos_organizacao',
            'origem_recursos_organizacao_outro',
            'despesas_organizacao',
            'despesas_organizacao_outro',
            'medidas_acessibilidade_organizacao',
            'medidas_acessibilidade_organizacao_outro',
            'participou_atividade_rnpcmr_organizacao',
            'participou_atividade_rnpcmr_organizacao_se_sim'
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