<?php

namespace NovoTema;
use MapasCulturais\App;


// class Theme extends \Subsite\Theme {
class Theme extends \MapasCulturais\Themes\BaseV2\Theme
{

    function _init()
    {

        $app = App::i();

        

        //$app->hook('template(agent.<<create|edit|single>>.tab-about):begin', function() {
            //$this->part('num_filhos', ['entity' => $this->data->entity]);
        //});

        // Informacoes Adicionais
        $app->hook('template(agent.edit.tabs):end', function() {
            $this->part('informacoes_adicionais', ['entity' => $this->data->entity]);
        });

        // Preservacao da Memoria Cultural
        $app->hook('template(agent.edit.tabs):end', function() {
            $this->part('preservacao_memoria_cultural', ['entity' => $this->data->entity]);
        });

        // Acesso a agua
        $app->hook('template(agent.edit.tabs):end', function() {
            $this->part('acesso_agua', ['entity' => $this->data->entity]);
        });

        // Saneamento Basico
        $app->hook('template(agent.edit.tabs):end', function() {
            $this->part('saneamento_basico', ['entity' => $this->data->entity]);
        });

        // Qualidade da Agua
        $app->hook('template(agent.edit.tabs):end', function() {
            $this->part('qualidade_agua', ['entity' => $this->data->entity]);
        });

        // Uso do Solo e Praticas agricolas
        $app->hook('template(agent.edit.tabs):end', function() {
            $this->part('solo_praticas_agricolas', ['entity' => $this->data->entity]);
        });

        // Seguranca Alimentar
        $app->hook('template(agent.edit.tabs):end', function() {
            $this->part('seguranca_alimentar', ['entity' => $this->data->entity]);
        });

        // Questoes Fundiarias e Conflitos Socioambientais
        $app->hook('template(agent.edit.tabs):end', function() {
            $this->part('questoes_fundiarias_conflitos_socioambientais', ['entity' => $this->data->entity]);
        });

        // Colaboracao e Redes
        $app->hook('template(agent.edit.tabs):end', function() {
            $this->part('colaboracao_redes', ['entity' => $this->data->entity]);
        });

        // Instancias e Participacao
        $app->hook('template(agent.edit.tabs):end', function() {
            $this->part('instancias_participacao', ['entity' => $this->data->entity]);
        });

        // Publicar assets
        $app->hook('view.render(<<*>>):before', function () use ($app) {
            $this->_publishAssets();
        });
    

        parent::_init();
        
    }

    static function getThemeFolder()
    {
        return __DIR__;
    }

    function register()
    {
        // Informacoes adicionais
        $this->registerAgentMetadata('sede_situada', array(
            'label' => 'Onde está situada a sede da Organização?',
            'type' => 'select',
            'options' => ['Sede na área rural', 'Sede na área urbana com ações na área rural', 'Não há sede']
            //'validations' => [
                //'v::intVal()' => 'O valor deve ser um numero inteiro'
            //]
        ));

        $this->registerAgentMetadata('atuacao_regioes_rurais', array(
            'label' => 'Em quais regiões rurais atua? (Para organizações com sede na Área Urbana)',
            'type' => 'text'
        ));

        $this->registerAgentMetadata('historico_organizacao', array(
            'label' => 'Insira um histórico da sua organização. Quando, onde e como iniciou atividades. O que realizou que destacaria?',
            'type' => 'text'
        ));
        // Informacoes adicionais

        // Preservacao da memoria cultural
        $this->registerAgentMetadata('atividades_pre_memo_cult', array(
            'label' => 'A sua organização realiza atividades que visam a preservação da memória cultural local?',
            'type' => 'select',
            'options' => ['Sim', 'Não']
        ));
        $this->registerAgentMetadata('atividades_pre_memo_cult_se_sim', array(
            'label' => 'Se sim, quais?',
            'type' => 'text'
        ));
        $this->registerAgentMetadata('acervo_ou_documentacao', array(
            'label' => 'Existe algum acervo ou documentação sobre a cultura local que a organização mantém?',
            'type' => 'select',
            'options' => ['Sim', 'Não']
        ));
        $this->registerAgentMetadata('eventos_ou_atividades', array(
            'label' => 'Que tipo de eventos ou atividades culturais são realizados na sua organização para promover a memória cultural?',
            'type' => 'text'
        ));
        $this->registerAgentMetadata('criacao_preservacao_novas_manifestacoes_culturais', array(
            'label' => 'A sua organização envolve a comunidade na criação e preservação de novas manifestações culturais?',
            'type' => 'select',
            'options' => ['Sim', 'Não']
        ));
        $this->registerAgentMetadata('criacao_preservacao_novas_manifestacoes_culturais_se_sim', array(
            'label' => 'Se sim, como isso acontece?',
            'type' => 'text'
        ));
        // Preservacao da memoria cultural

        // Acesso a agua
        $this->registerAgentMetadata('principal_fonte_abastecimento', array(
            'label' => 'Qual é a principal fonte de abastecimento de água utilizada pela sua comunidade? (poços, rios, cisternas, sistema de abastecimento público, etc.)',
            'type' => 'text'
        ));
        $this->registerAgentMetadata('facilidade_acesso_agua_potavel', array(
            'label' => 'Há facilidade de acesso à água potável para todos os moradores da sua comunidade?',
            'type' => 'select',
            'options' => ['Sim', 'Não']
        ));
        $this->registerAgentMetadata('facilidade_acesso_agua_potavel_se_nao', array(
            'label' => 'Se não, quais são os principais obstáculos enfrentados?',
            'type' => 'text'
        ));
        $this->registerAgentMetadata('quantidade_agua_disponivel_suficiente', array(
            'label' => 'A quantidade de água disponível é suficiente para atender às necessidades da comunidade? (para consumo, agricultura, atividades domésticas, etc.)',
            'type' => 'select',
            'options' => ['Sim', 'Não']
        ));
        $this->registerAgentMetadata('iniciativas_coleta_armazenamento_chuva', array(
            'label' => 'Há iniciativas na sua comunidade para a coleta e armazenamento de água da chuva?',
            'type' => 'select',
            'options' => ['Sim', 'Não']
        ));
        $this->registerAgentMetadata('iniciativas_coleta_armazenamento_chuva_se_sim', array(
            'label' => 'Se sim, quais?',
            'type' => 'text'
        ));
        $this->registerAgentMetadata('lidar_escassez_agua', array(
            'label' => 'Como a comunidade lida com a escassez de água em períodos de seca?',
            'type' => 'text'
        ));
        // Acesso a agua

        // Saneamento basico
        $this->registerAgentMetadata('saneamento_basico_organizacao', array(
            'label' => 'Há saneamento básico na sua organização?',
            'type' => 'select',
            'options' => ['Sim', 'Não']
        ));
        $this->registerAgentMetadata('saneamento_basico_comunidade', array(
            'label' => 'Há saneamento básico na sua comunidade?',
            'type' => 'select',
            'options' => ['Sim', 'Não']
        ));
        // Saneamento basico

        // Qualidade da agua
        $this->registerAgentMetadata('agua_comunidade_frequentemente_testada', array(
            'label' => 'A água disponível na sua comunidade é frequentemente testada quanto à sua qualidade?',
            'type' => 'select',
            'options' => ['Sim', 'Não']
        ));
        $this->registerAgentMetadata('agua_comunidade_frequentemente_testada_se_sim', array(
            'label' => 'Se sim, quais foram os resultados mais recentes?',
            'type' => 'text'
        ));
        $this->registerAgentMetadata('problemas_saude_devido_qualidade_agua ', array(
            'label' => 'Quais problemas de saúde, se houver, foram associados à qualidade da água na sua região?',
            'type' => 'text'
        ));
        $this->registerAgentMetadata('campanhas_conscientizacao_importancia_qualidade_agua', array(
            'label' => 'Existem campanhas de conscientização na comunidade sobre a importância da qualidade da água?',
            'type' => 'select',
            'options' => ['Sim', 'Não']
        ));
        $this->registerAgentMetadata('campanhas_conscientizacao_importancia_qualidade_agua_se_sim', array(
            'label' => 'Se sim, como elas são conduzidas?',
            'type' => 'text'
        ));
        $this->registerAgentMetadata('medidas_tomadas_organizacao_qualidade_agua', array(
            'label' => 'Que medidas são tomadas pela sua organização para melhorar a qualidade da água na comunidade?',
            'type' => 'text'
        ));
        // Qualidade da agua

        // Uso do solo e praticas agricolas
        $this->registerAgentMetadata('principal_tipo_cultivo_regiao', array(
            'label' => 'Qual é o principal tipo de cultivo realizado na sua região? (monocultivos, policultivos, etc.)',
            'type' => 'text'
        ));
        $this->registerAgentMetadata('praticas_agricultura_sustentavel_aplicadas', array(
            'label' => 'Existem práticas de agricultura sustentável sendo aplicadas?',
            'type' => 'select',
            'options' => ['Sim', 'Não']
        ));
        $this->registerAgentMetadata('praticas_agricultura_sustentavel_aplicadas_se_sim', array(
            'label' => 'Se sim, quais?',
            'type' => 'text'
        ));
        $this->registerAgentMetadata('uso_agrotoxicos', array(
            'label' => 'O uso de agrotóxicos é comum na sua região?',
            'type' => 'select',
            'options' => ['Sim', 'Não']
        ));
        $this->registerAgentMetadata('uso_agrotoxicos_se_sim', array(
            'label' => 'Se sim, quais são os principais produtos utilizados?',
            'type' => 'text'
        ));
        $this->registerAgentMetadata('perceber_efeitos_uso_agrotoxico', array(
            'label' => 'Como a comunidade percebe os efeitos do uso de agrotóxicos na saúde e no meio ambiente?',
            'type' => 'text'
        ));
        $this->registerAgentMetadata('criacao_gados', array(
            'label' => 'A criação de gado é uma prática na sua comunidade?',
            'type' => 'select',
            'options' => ['Sim', 'Não']
        ));
        $this->registerAgentMetadata('criacao_gados_se_sim', array(
            'label' => 'Se sim, quais impactos essa atividade traz para o solo e a água?',
            'type' => 'text'
        ));
        // Uso do solo e praticas agricolas

        // Seguranca alimentar
        $this->registerAgentMetadata('possui_espaco_producao_alimentos', array(
            'label' => 'A organização possui um espaço (quintal ou terreiro) dedicado à produção de alimentos?',
            'type' => 'select',
            'options' => ['Sim', 'Não']
        ));
        $this->registerAgentMetadata('possui_espaco_producao_alimentos_se_sim', array(
            'label' => 'Se sim, quais tipos de alimentos  mais cultiva?',
            'type' => 'text'
        ));
        $this->registerAgentMetadata('praticas_agroecologia_utiliza_producao', array(
            'label' => 'Quais práticas de agroecologia  utiliza em sua produção? (Ex.: compostagem, rotação de culturas, uso de insumos orgânicos)',
            'type' => 'text'
        ));
        $this->registerAgentMetadata('participou_iniciativa_comercializacao_alimentos_governo', array(
            'label' => 'Já participou de alguma iniciativa de comercialização de alimentos para programas de governo, como o Programa de Aquisição de Alimentos (PAA)?',
            'type' => 'select',
            'options' => ['Sim', 'Não']
        ));
        $this->registerAgentMetadata('participou_iniciativa_comercializacao_alimentos_governo_se_sim', array(
            'label' => 'Se sim, como foi sua experiência?',
            'type' => 'text'
        ));
        $this->registerAgentMetadata('canais_vendas_produtos', array(
            'label' => 'Como você avalia os canais de venda dos seus produtos?',
            'type' => 'text'
        ));
        $this->registerAgentMetadata('sente_suficientes_garantir_renda_justo', array(
            'label' => 'Você sente que eles são suficientes para garantir uma renda justa?',
            'type' => 'select',
            'options' => ['Sim', 'Não']
        ));
        $this->registerAgentMetadata('hortas_comunitarias', array(
            'label' => 'Sua comunidade possui hortas comunitárias?',
            'type' => 'select',
            'options' => ['Sim', 'Não']
        ));
        $this->registerAgentMetadata('hortas_comunitarias_se_sim', array(
            'label' => 'Se sim, como elas são geridas e que papel desempenham na segurança alimentar local?',
            'type' => 'text'
        ));
        $this->registerAgentMetadata('hortas_comunitarias_se_sim_segundo', array(
            'label' => 'Se sim, quais benefícios você enxerga nas hortas comunitárias para a sua comunidade?',
            'type' => 'text'
        ));
        $this->registerAgentMetadata('feiras_livres', array(
            'label' => 'Você participa de feiras livres ou feiras de agricultores na sua região?',
            'type' => 'select',
            'options' => ['Sim', 'Não']
        ));
        $this->registerAgentMetadata('feiras_livres_se_sim', array(
            'label' => 'Se sim, como é a experiência de comercializar/localizar alimentos aí?',
            'type' => 'text'
        ));
        $this->registerAgentMetadata('iniciativas_colaborativas_producao_consumo', array(
            'label' => 'Você conhece ou participa de iniciativas colaborativas de produçao e consumo como CSA (Comunidade que Sustenta a Agricultura) ou outras?',
            'type' => 'select',
            'options' => ['Sim', 'Não']
        ));
        $this->registerAgentMetadata('iniciativas_colaborativas_producao_consumo_se_sim', array(
            'label' => 'Se sim, quais e como é a relação entre consumidores e produtores nesse modelo?',
            'type' => 'text'
        ));
        $this->registerAgentMetadata('principais_desafios_seguranca_alimentar', array(
            'label' => 'Quais são os principais desafios que você enfrenta em relação à segurança alimentar na sua comunidade?',
            'type' => 'text'
        ));
        $this->registerAgentMetadata('apoio_recurso_melhorar_producao_comercializacao', array(
            'label' => 'Que tipo de apoio ou recursos seriam mais úteis para melhorar a produção e comercialização de alimentos na sua região?',
            'type' => 'text'
        ));
        // Seguranca alimentar

        // Questoes fundiarias e conflitos socioambientais
        $this->registerAgentMetadata('conflitos_relacionados_terra', array(
            'label' => 'Existem conflitos relacionados à terra no seu território?',
            'type' => 'select',
            'options' => ['Sim', 'Não']
        ));
        $this->registerAgentMetadata('conflitos_relacionados_terra_se_sim', array(
            'label' => 'Se sim, com que grupos?',
            'type' => 'text'
        ));
        $this->registerAgentMetadata('poder_publico_lidado_conflitos', array(
            'label' => 'Como o poder público tem lidado com as questões fundiárias e os conflitos socioambientais?',
            'type' => 'text'
        ));
        $this->registerAgentMetadata('enfrentou_conflitos_vizinhos_empresas', array(
            'label' => 'A sua comunidade já enfrentou conflitos com vizinhos ou empresas em relação ao uso da terra?',
            'type' => 'select',
            'options' => ['Sim', 'Não']
        ));
        $this->registerAgentMetadata('enfrentou_conflitos_vizinhos_empresas_se_sim', array(
            'label' => 'Se sim, como foram resolvidos?',
            'type' => 'text'
        ));
        $this->registerAgentMetadata('apoio_resistencia_grandes_empreendimentos', array(
            'label' => 'Há apoio ou resistência da comunidade em relação a grandes empreendimentos na região?',
            'type' => 'select',
            'options' => ['Sim', 'Não']
        ));
        $this->registerAgentMetadata('apoio_resistencia_grandes_empreendimentos_se_sim', array(
            'label' => 'Se sim, quais são as principais preocupações?   ',
            'type' => 'text'
        ));
        // Questoes fundiarias e conflitos socioambientais

        // Colaboracao e redes
        $this->registerAgentMetadata('rede_parceria_outras_instituicoes', array(
            'label' => 'A organização faz parte de alguma rede ou parceria com outras instituições?',
            'type' => 'select',
            'options' => ['Sim', 'Não']
        ));
        $this->registerAgentMetadata('rede_parceria_outras_instituicoes_se_sim', array(
            'label' => 'Se sim, quais?',
            'type' => 'text'
        ));
        $this->registerAgentMetadata('principais_desafios_integrar_redes_parcerias', array(
            'label' => 'Quais são os principais desafios que a sua organização enfrenta ao tentar se integrar em redes ou parcerias?',
            'type' => 'text'
        ));
        $this->registerAgentMetadata('importancia_colaboracoes_desenvolvimento_cultural', array(
            'label' => 'Como você enxerga a importância dessas colaborações para o desenvolvimento cultural e ambiental na região?',
            'type' => 'text'
        ));
        $this->registerAgentMetadata('colaboracoes_outras_instituicoes_trazer_beneficios', array(
            'label' => 'De que maneira as colaborações com outras instituições podem trazer benefícios diretos para a comunidade?',
            'type' => 'text'
        ));
        // Colaboracao e redes

        // Instancias de participacao
        $this->registerAgentMetadata('conselho_comite_relacionados_cultura', array(
            'label' => 'Você faz parte de algum conselho ou comitê na sua região que trate de assuntos relacionados à cultura, ruralidade ou cultura alimentar?',
            'type' => 'select',
            'options' => ['Sim', 'Não']
        ));
        $this->registerAgentMetadata('conselho_comite_relacionados_cultura_se_sim', array(
            'label' => 'Se sim, qual?',
            'type' => 'text'
        ));
        $this->registerAgentMetadata('avalia_importancia_participacao_instancias', array(
            'label' => 'Como você avalia a importância da sua participação nessas instâncias? De que maneira isso influencia as decisões locais?',
            'type' => 'text'
        ));
        $this->registerAgentMetadata('comunidade_participa_foruns_encontros_discutir_cultura', array(
            'label' => 'Sua comunidade participa de fóruns ou encontros regulares para discutir temas relacionados à cultura e agricultura?',
            'type' => 'select',
            'options' => ['Sim', 'Não']
        ));
        $this->registerAgentMetadata('comunidade_participa_foruns_encontros_discutir_cultura_se_sim', array(
            'label' => 'Se sim, como esses encontros são organizados?',
            'type' => 'text'
        ));
        $this->registerAgentMetadata('principais_discussoes_decisoes_participacao_foruns', array(
            'label' => 'Quais foram as principais discussões ou decisões resultantes de sua participação em fóruns? Você sentiu que sua voz foi ouvida?',
            'type' => 'text'
        ));
        $this->registerAgentMetadata('acesso_informacoes_sobre_instancias_disponiveis_regiao', array(
            'label' => 'Você tem acesso a informações sobre as instâncias de participação disponíveis em sua região?',
            'type' => 'select',
            'options' => ['Sim', 'Não']
        ));
        $this->registerAgentMetadata('acesso_informacoes_sobre_instancias_disponiveis_regiao_se_sim', array(
            'label' => 'Se sim, como você se informa sobre essas oportunidades?',
            'type' => 'text'
        ));
        $this->registerAgentMetadata('principais_lacunas_informacao_apoio_esferas', array(
            'label' => 'Quais seriam, na sua opinião, as principais lacunas de informação ou apoio que dificultam uma maior participação nas esferas estadual, municipal e federal?',
            'type' => 'text'
        ));
        $this->registerAgentMetadata('mudanca_significativa_politicas_publicas_cultura', array(
            'label' => 'Você percebe alguma mudança significativa nas políticas públicas relacionadas à cultura e ruralidade devido à atuação de conselhos ou fóruns na sua comunidade?',
            'type' => 'select',
            'options' => ['Sim', 'Não']
        ));
        $this->registerAgentMetadata('algum_exemplo_participacao_resultou_mudanca', array(
            'label' => 'Existe algum exemplo em que sua participação resultou em uma mudança prática ou melhoria na sua comunidade?',
            'type' => 'text'
        ));
        $this->registerAgentMetadata('sugestoes_aumentar_participacao', array(
            'label' => 'Que sugestões você teria para aumentar a participação da comunidade nas instâncias estaduais e municipais?',
            'type' => 'text'
        ));
        $this->registerAgentMetadata('imagina_fortalecimento_instancias_beneficiar_cultura', array(
            'label' => 'Como você imagina que o fortalecimento dessas instâncias poderia beneficiar a cultura alimentar e as práticas rurais na sua região?',
            'type' => 'text'
        ));
        // Instancias de participacao
    }

    protected function _publishAssets()
    {

        // $this->jsObject['assets']['logo-instituicao'] = $this->asset('img/logo-instituicao.png', false);

        // $this->enqueueScript('app', 'hide-fields', 'js/hide-fields.js');
    }
}
