<?php

namespace NovoTema;

use MapasCulturais\App;


// class Theme extends \Subsite\Theme {
class Theme extends \MapasCulturais\Themes\BaseV2\Theme
{

    function _init()
    {

        $app = App::i();

        $app->hook('template(<<*>>.body):end', function () use ($app) {
            $desc = $app->config['home.header.description'];
            echo "<script>
                const newDescription = " . json_encode($desc) . ";
                const interval = setInterval(() => {
                    const el = document.querySelector('.home-header__description');
                    if (el) {
                        el.innerHTML = '<span style=\"color: white; font-size: 18px; font-weight: bold;\">' + newDescription + '</span>';
                        clearInterval(interval);
                    }
                }, 100); // checa a cada 100ms
            </script>";

            $titulo = $app->config['home.header.title'] ?? 'Bem-vindo!';
            echo "<script>
                const newTitle = " . json_encode($titulo) . ";
                const intervalTitle = setInterval(() => {
                    const el = document.querySelector('.home-header__title');
                    if (el) {
                        el.innerHTML = '<span style=\"color: white; font-size: 32px; margin-botton: 120px;\">' + newTitle + '</span>';
                        clearInterval(intervalTitle);
                    }
                }, 100);
            </script>";
        });

        // Informacoes Adicionais
        $app->hook('template(agent.edit.tabs):end', function () {
            $this->part('informacoes_adicionais', ['entity' => $this->data->entity]);
        });

        // Diagnóstico - Representantes de Organização
        $app->hook('template(agent.edit.tabs):end', function () {
            $this->part('representantes_organizacao', ['entity' => $this->data->entity]);
        });

        // Diagnóstico - Equipes de Organização
        $app->hook('template(agent.edit.tabs):end', function () {
            $this->part('equipes_organizacao', ['entity' => $this->data->entity]);
        });

        // Diagnóstico - Organização
        $app->hook('template(agent.edit.tabs):end', function () {
            $this->part('diagnostico_organizacao', ['entity' => $this->data->entity]);
        });

        // Preservacao da Memoria Cultural
        $app->hook('template(agent.edit.tabs):end', function () {
            $this->part('preservacao_memoria_cultural', ['entity' => $this->data->entity]);
        });

        // Acesso a agua
        $app->hook('template(agent.edit.tabs):end', function () {
            $this->part('acesso_agua', ['entity' => $this->data->entity]);
        });

        // Saneamento Basico
        $app->hook('template(agent.edit.tabs):end', function () {
            $this->part('saneamento_basico', ['entity' => $this->data->entity]);
        });

        // Qualidade da Agua
        $app->hook('template(agent.edit.tabs):end', function () {
            $this->part('qualidade_agua', ['entity' => $this->data->entity]);
        });

        // Uso do Solo e Praticas agricolas
        $app->hook('template(agent.edit.tabs):end', function () {
            $this->part('solo_praticas_agricolas', ['entity' => $this->data->entity]);
        });

        // Seguranca Alimentar
        $app->hook('template(agent.edit.tabs):end', function () {
            $this->part('seguranca_alimentar', ['entity' => $this->data->entity]);
        });

        // Questoes Fundiarias e Conflitos Socioambientais
        $app->hook('template(agent.edit.tabs):end', function () {
            $this->part('questoes_fundiarias_conflitos_socioambientais', ['entity' => $this->data->entity]);
        });

        // Colaboracao e Redes
        $app->hook('template(agent.edit.tabs):end', function () {
            $this->part('colaboracao_redes', ['entity' => $this->data->entity]);
        });

        // Instancias e Participacao
        $app->hook('template(agent.edit.tabs):end', function () {
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
            'options' => ['Sede na área rural', 'Sede na área urbana com ações na área rural', 'Não há sede'],
            'validations' => [
                'required' => 'Campo obrigatório'
            ]
        ));

        $this->registerAgentMetadata('atuacao_regioes_rurais', array(
            'label' => 'Em quais regiões rurais atua? (Para organizações com sede na Área Urbana)',
            'type' => 'text',
            'validations' => [
                'required' => 'Campo obrigatório'
            ]
        ));

        $this->registerAgentMetadata('historico_organizacao', array(
            'label' => 'Insira um histórico da sua organização. Quando, onde e como iniciou atividades. O que realizou que destacaria?',
            'type' => 'text',
            'validations' => [
                'required' => 'Campo obrigatório'
            ]
        ));

        $this->registerAgentMetadata('quais_acoes_foram_desenvolvidos', array(
            'label' => 'Qual(is) ação(ões) ou produto(s) de comunicação foi(ram) desenvolvido(s)?',
            'type' => 'multiselect',
            'options' => [
                'Organização de rede de comunicadoras/es populares',
                'Estratégia corpo-a-corpo de comunicação',
                'Produção de cartaz, folder ou banner',
                'Produção de matérias',
                'Produção de vídeos',
                'Produção de podcast',
                'Divulgação nas redes sociais',
                'Produção de revista',
                'Produção de artigos acadêmicos',
                'Produção de livro ou cartilha',
                'Assessoria de imprensa',
                'Outros',
                'Não foi desenvolvida nenhuma ação ou produto de comunicação'
            ],
            'validations' => [
                'required' => 'Campo obrigatório'
            ]
        ));

        $this->registerAgentMetadata('quais_acoes_foram_desenvolvidos_outros', array(
            'label' => 'Outros quais? (caso não se aplique, insira "NSA - Não Se Aplica")',
            'type' => 'text',
            'validations' => [
                'required' => 'Campo obrigatório'
            ]
        ));

        $this->registerAgentMetadata('impactos_mudancas_climaticas', array(
            'label' => 'Como a experiência percebe os impactos das mudanças climáticas no território?',
            'type' => 'multiselect',
            'options' => [
                'Diminuição da produção',
                'Perda de produção',
                'Diminuição das chuvas',
                'Aumento das chuvas',
                'Alteração no calendário de chuvas',
                'Chuvas extremas',
                'Diminuição da disponibilidade hídrica',
                'Maiores distâncias para acesso à água',
                'Deslizamento de áreas',
                'Aumento da temperatura',
                'Alteração nas estações (prolongamento/diminuição das estações)',
                'Alagamento de áreas',
                'Erosão do solo',
                'Desertificação',
                'Desaparecimento de espécies e variedades vegetais nativas',
                'Desaparecimento de espécies e variedades animais nativas',
                'Desaparecimento de espécies e variedades vegetais agrícolas',
                'Desaparecimento de espécies e variedades animais (criação animal)',
                'Aumento de plantas espontâneas',
                'Aumento de doenças nas plantas (moscas, protozoários, fungos etc)',
                'Aumento de doenças nas criações animais',
                'Aumento de doenças nos humanos (cardíacas, diminuição de imunidade, adoecimento mental)',
                'Piora na qualidade do ar',
                'Não há efeitos das mudanças climáticas no território.',
                'Não sei aferir',
                'Outras'
            ],
            'validations' => [
                'required' => 'Campo obrigatório'
            ]
        ));

        $this->registerAgentMetadata('impactos_mudancas_climaticas_outras', array(
            'label' => 'Outras quais? (caso não se aplique, insira "NSA - Não Se Aplica")',
            'type' => 'text',
            'validations' => [
                'required' => 'Campo obrigatório'
            ]
        ));

        $this->registerAgentMetadata('quantas_pessoas_beneficiadas_por_mes', array(
            'label' => 'Quantas pessoas a experiência beneficia diretamente por mês?',
            'type' => 'select',
            'options' => [
                'de 1 a 20',
                'de 21 a 50',
                'de 51 a 100',
                'de 101 a 300',
                'de 301 e 500',
                'de 501 a 1000',
                'mais de 1000',
                'Não é possível aferir'
            ],
            'validations' => [
                'required' => 'Campo obrigatório'
            ]
        ));

        // Informacoes adicionais

        // Diagnóstico - Representantes da Organização
        $this->registerAgentMetadata('representante_legal_organizacao', array(
            'label' => 'Representante Legal da Organização',
            'type' => 'text',
            'validations' => [
                'required' => 'Campo obrigatório'
            ]
        ));

        $this->registerAgentMetadata('funcao_exerce_organizacao', array(
            'label' => 'Qual função você exerce na organização?',
            'type' => 'select',
            'options' => ['Diretoria', 'Coordenador (a)', 'Educador (a)', 'Arte Educador (a)', 'Outra'],
            'validations' => [
                'required' => 'Campo obrigatório'
            ]
        ));

        $this->registerAgentMetadata('funcao_exerce_organizacao_outra', array(
            'label' => 'Outra qual? (caso não se aplique, insira "NSA - Não Se Aplica")',
            'type' => 'text',
            'validations' => [
                'required' => 'Campo obrigatório'
            ]
        ));
        
        $this->registerAgentMetadata('orientacao_sexual_organizacao', array(
            'label' => 'Assinale qual sua orientação sexual',
            'type' => 'select',
            'options' => ['Heterossexual', 'Homossexual', 'Lésbica', 'Bissexual', 'Prefiro não declarar', 'Outra'],
            'validations' => [
                'required' => 'Campo obrigatório'
            ]
        ));

        $this->registerAgentMetadata('orientacao_sexual_organizacao_outra', array(
            'label' => 'Outra qual? (caso não se aplique, insira "NSA - Não Se Aplica")',
            'type' => 'text',
            'validations' => [
                'required' => 'Campo obrigatório'
            ]
        ));

        $this->registerAgentMetadata('identidade_genero_organizacao', array(
            'label' => 'Assinale sua identidade de gênero (Cisgênero e transgênero: termos usados para caracterizar identidades de gênero de forma mais ampla. Pessoa cisgênera: se identifica com o gênero que lhe foi atribuído ao nascer (feminino/mulher cisgênera; masculino/homem cisgênero). Pessoa transgênera: se identifica (ou pode se identificar, a partir de determinado momento da vida) com um gênero diferente daquele que lhe foi atribuído ao nascer. Ou seja, ao nascer, por seu sexo biológico, uma pessoa pode ser considerada de um gênero — homem/masculino, por exemplo —, mas esse gênero não corresponde a como ela se encara e se identifica; nesse caso, essa pessoa trans pode se identificar como feminina/mulher, entre outras possibilidades.)',
            'type' => 'select',
            'options' => ['Mulher Cisgênero', 'Homem Cisgênero', 'Mulher Transgênero', 'Homem Transgênero', 'Travesti', 'Não binário', 'Prefiro não declarar', 'Outra'],
            'validations' => [
                'required' => 'Campo obrigatório'
            ]
        ));

        $this->registerAgentMetadata('identidade_genero_organizacao_outra', array(
            'label' => 'Outra qual? (caso não se aplique, insira "NSA - Não Se Aplica")',
            'type' => 'text',
            'validations' => [
                'required' => 'Campo obrigatório'
            ]
        ));

        $this->registerAgentMetadata('idade_organizacao', array(
            'label' => 'Qual a sua idade?',
            'type' => 'string',
            'validations' => [
                'v::intVal()' => 'O valor deve ser um número inteiro',
                'required' => 'Campo obrigatório'
            ]
        ));

        $this->registerAgentMetadata('raca_cor_etnia_organizacao', array(
            'label' => 'Qual sua Raça/Cor/Etnia',
            'type' => 'select',
            'options' => ['Preto', 'Pardo', 'Branco', 'Indígena', 'Cigano', 'Amarelo', 'Não sei responder', 'Outro'],
            'validations' => [
                'required' => 'Campo obrigatório'
            ]
        ));

        $this->registerAgentMetadata('raca_cor_etnia_organizacao_outro', array(
            'label' => 'Outro qual? (caso não se aplique, insira "NSA - Não Se Aplica")',
            'type' => 'text',
            'validations' => [
                'required' => 'Campo obrigatório'
            ]
        ));

        $this->registerAgentMetadata('vinculo_trabalho_organizacao', array(
            'label' => 'Qual o seu vínculo de trabalho com a organização?',
            'type' => 'select',
            'options' => ['Autônomo', 'Micro Empreendedor', 'Carteira Assinada', 'Voluntário', 'Cigano'],
            'validations' => [
                'required' => 'Campo obrigatório'
            ]
        ));

        $this->registerAgentMetadata('vinculo_trabalho_remunerado_organizacao', array(
            'label' => 'Se tem em vinculo de trabalho remunerado, qual função de te proporciona isso?',
            'type' => 'text',
            'validations' => [
                'required' => 'Campo obrigatório'
            ]
        ));

        $this->registerAgentMetadata('trabalha_voluntariamente_organizacao', array(
            'label' => 'Se trabalha voluntariamente, qual sua fonte de renda principal?',
            'type' => 'text',
            'validations' => [
                'required' => 'Campo obrigatório'
            ]
        ));

        $this->registerAgentMetadata('politica_nacional_cultura_viva_organizacao', array(
            'label' => 'Conhece a Política Nacional Cultura Viva?',
            'type' => 'select',
            'options' => ['Sim', 'Não'],
            'validations' => [
                'required' => 'Campo obrigatório'
            ]
        ));

        $this->registerAgentMetadata('pontos_cultura_organizacao', array(
            'label' => 'Conhece os Pontos de Cultura?',
            'type' => 'select',
            'options' => ['Sim', 'Não'],
            'validations' => [
                'required' => 'Campo obrigatório'
            ]
        ));

        $this->registerAgentMetadata('acesso_internet_organizacao', array(
            'label' => 'Tem acesso à internet?',
            'type' => 'select',
            'options' => ['Na organização/coletivo', 'Em casa', 'Outro local', 'Não possuo internet'],
            'validations' => [
                'required' => 'Campo obrigatório'
            ]
        ));

        $this->registerAgentMetadata('interesse_fazer_parte_grupo_organizacao', array(
            'label' => 'Você tem interesse em fazer parte do grupo de Whatsapp para INTEGRAR o Fórum Nacional Territórios Rurais e Cultura Alimentar e colaborar com a Rede do Pontão de Cultura e Memória Rurais, trazendo ideias, propostas e sugestões para fortalecer as pautas de políticas públicas?',
            'type' => 'select',
            'options' => ['Sim', 'Não'],
            'validations' => [
                'required' => 'Campo obrigatório'
            ]
        ));
        // Diagnóstico - Representantes da Organização

        // Diagnóstico - Equipes da Organização
        $this->registerAgentMetadata('orientacao_sexual_equipe_organizacao', array(
            'label' => 'Assinale as orientações sexuais presentes na equipe da organização',
            'allowOtherText' => 'Outra qual?',
            'options' => ['Heterossexual', 'Homossexual', 'Lésbica', 'Bissexual', 'Prefiro não declarar', 'Outras'],
            'validations' => [
                'required' => 'Campo obrigatório'
            ]
        ));

        $this->registerAgentMetadata('orientacao_sexual_equipe_organizacao_outra', array(
            'label' => 'Outras quais? (caso não se aplique, insira "NSA - Não Se Aplica")',
            'type' => 'text',
            'validations' => [
                'required' => 'Campo obrigatório'
            ]
        ));

        $this->registerAgentMetadata('identidade_genero_equipe_organizacao', array(
            'label' => 'Assinale quais identidade de gênero estão presentes na equipe da organização. (Cisgênero e transgênero: termos usados para caracterizar identidades de gênero de forma mais ampla. Pessoa cisgênera: se identifica com o gênero que lhe foi atribuído ao nascer (feminino/mulher cisgênera; masculino/homem cisgênero). Pessoa transgênera: se identifica (ou pode se identificar, a partir de determinado momento da vida) com um gênero diferente daquele que lhe foi atribuído ao nascer. Ou seja, ao nascer, por seu sexo biológico, uma pessoa pode ser considerada de um gênero — homem/masculino, por exemplo —, mas esse gênero não corresponde a como ela se encara e se identifica; nesse caso, essa pessoa trans pode se identificar como feminina/mulher, entre outras possibilidades.)',
            'type' => 'multiselect',
            'options' => ['Mulher Cisgênero', 'Homem Cisgênero', 'Mulher Transgênero', 'Homem Transgênero', 'Travesti', 'Não binário', 'Prefiro não declarar', 'Outras'],
            'validations' => [
                'required' => 'Campo obrigatório'
            ]
        ));

        $this->registerAgentMetadata('identidade_genero_equipe_organizacao_outra', array(
            'label' => 'Outras quais? (caso não se aplique, insira "NSA - Não Se Aplica")?',
            'type' => 'text',
            'validations' => [
                'required' => 'Campo obrigatório'
            ]
        ));

        $this->registerAgentMetadata('raca_cor_etnia_equipe_organizacao', array(
            'label' => 'Na organização estão presentes quais composições de Raça/Cor/Etnia?',
            'type' => 'multiselect',
            'options' => ['Preto', 'Pardo', 'Branco', 'Indígena', 'Cigano', 'Amarelo', 'Não sei responder', 'Outros'],
            'validations' => [
                'required' => 'Campo obrigatório'
            ]
        ));

        $this->registerAgentMetadata('raca_cor_etnia_equipe_organizacao_outro', array(
            'label' => 'Outros quais? (caso não se aplique, insira "NSA - Não Se Aplica")',
            'type' => 'text',
            'validations' => [
                'required' => 'Campo obrigatório'
            ]
        ));

        $this->registerAgentMetadata('deficiencia_equipe_organizacao', array(
            'label' => 'Na organização existem pessoas com deficiência?',
            'type' => 'select',
            'options' => ['Sim', 'Não'],
            'validations' => [
                'required' => 'Campo obrigatório'
            ]
        ));

        $this->registerAgentMetadata('quais_pessoas_participam_equipe_organizacao', array(
            'label' => 'Assinale quais pessoas participam da coordenação ou direção da organização',
            'type' => 'multiselect',
            'options' => ['Mulheres', 'Negros e negras', 'Indígenas (Povo Originário)', 'Quilombola (Povo Afro-Brasileiro)', 'Caiçaras, Ciganos, Quebradeiras de Coco, erveiras ou outros povos tradicionais', 'Pessoa com deficiência', 'Outras'],
            'validations' => [
                'required' => 'Campo obrigatório'
            ]
        ));

        $this->registerAgentMetadata('quais_pessoas_participam_equipe_organizacao_outras', array(
            'label' => 'Outras quais? (caso não se aplique, insira "NSA - Não Se Aplica")?',
            'type' => 'text',
            'validations' => [
                'required' => 'Campo obrigatório'
            ]
        ));

        $this->registerAgentMetadata('quais_vinculos_trabalho_equipe_organizacao', array(
            'label' => 'Quais vínculo de trabalho tem sido estabelecido na organização?',
            'type' => 'multiselect',
            'options' => ['Autônomo', 'Micro Empreendedor', 'Carteira Assinada', 'Voluntário'],
            'validations' => [
                'required' => 'Campo obrigatório'
            ]
        ));
        // Diagnóstico - Equipes da Organização

        // Diagnóstico - Organização
        $this->registerAgentMetadata('quantos_habitantes_organizacao', array(
            'label' => 'Quais vínculo de trabalho tem sido estabelecido na organização?',
            'type' => 'select',
            'options' => ['Menos de 5 mil habitantes', '5 mil e 10 mil habitantes', '10 mil e 15 mil habitantes', '15 mil a 30 mil habitantes', '30 mil a 50 mil habitantes', '50 a 80 mil habitantes', '80 a 100 mil habitantes', 'mais de 100 mil habitantes'],
            'validations' => [
                'required' => 'Campo obrigatório'
            ]
        ));

        $this->registerAgentMetadata('quantos_anos_atua_organizacao', array(
            'label' => 'Há quantos anos a organização atua?',
            'type' => 'text',
            'validations' => [
                'required' => 'Campo obrigatório'
            ]
        ));

        $this->registerAgentMetadata('certificada_organizacao', array(
            'label' => 'A organização é certificada?',
            'type' => 'select',
            'options' => ['Sim. Como Ponto de Memória.', 'Sim. Como Ponto de Cultura.', 'Sim. Como Ponto de Memória e Ponto de Cultura.', 'Não'],
            'validations' => [
                'required' => 'Campo obrigatório'
            ]
        ));

        $this->registerAgentMetadata('gostaria_ser_certificada_organizacao', array(
            'label' => 'Se não foi certificada, gostaria de ser?',
            'type' => 'select',
            'options' => ['Sim', 'Somos certificados', 'Não'],
            'validations' => [
                'required' => 'Campo obrigatório'
            ]
        ));

        $this->registerAgentMetadata('estagio_desenvolvimento_organizacao', array(
            'label' => 'Em que estágio de desenvolvimento sua organização ou coletivo está em relação aos requisitos para a certificação como Ponto de Cultura?',
            'type' => 'select',
            'options' => ['Não estamos familiarizados com os requisitos e não temos interesse no reconhecimento.', 'Não estamos familiarizados com os requisitos, mas temos interesse no reconhecimento.', 'Cientes dos requisitos, ainda avaliamos o interesse antes de iniciar o processo.', 'Estamos iniciando a organização para atender aos requisitos e temos interesse no reconhecimento.', 'Já atendemos a alguns requisitos e estamos em fase avançada de preparação, com interesse em obter o reconhecimento.', 'Já atendemos a todos os requisitos e estamos prontos para solicitar a certificação, com forte interesse no reconhecimento.', 'Já somos certificados'],
            'validations' => [
                'required' => 'Campo obrigatório'
            ]
        ));

        $this->registerAgentMetadata('programa_faz_parte_organizacao', array(
            'label' => 'De quais programas a sua organização faz parte?',
            'type' => 'multiselect',
            'options' => ['Pontões de Cultura', 'Escola Viva', 'Griô', 'Rede', 'Teia', 'Cultura Digital', 'Comitê de Cultura', 'Agente Cultura Viva', 'Plano Nacional de Cultura', 'Sistema Nacional de Cultura', 'Agente Territorial de Cultura', 'Fórum Estadual de Pontos de Cultura', 'Fórum Nacional de Pontos de Cultura', 'Outros'],
            'allowOther' => true,
            'allowOtherText' => 'Outra qual?',
            'validations' => [
                'required' => 'Campo obrigatório'
            ]
        ));

        $this->registerAgentMetadata('programa_faz_parte_organizacao_outro', array(
            'label' => 'Outros quais? (caso não se aplique, insira "NSA - Não Se Aplica")?',
            'type' => 'text',
            'validations' => [
                'required' => 'Campo obrigatório'
            ]
        ));

        $this->registerAgentMetadata('escala_atuacao_organizacao', array(
            'label' => 'Assinale a escala de atuação da organização',
            'type' => 'select',
            'options' => ['Local', 'Municipal', 'Regional', 'Estadual', 'Nacional', 'Internacional'],
            'validations' => [
                'required' => 'Campo obrigatório'
            ]
        ));

        $this->registerAgentMetadata('territorio_povos_comunidades_organizacao', array(
            'label' => 'Está em território de povos e comunidades tradicionais?',
            'type' => 'multiselect',
            'options' => ['Povos Indígenas', 'Quilombolas', 'Seringueiros', 'Castanheiros', 'Quebradeiras de coco-de-babaçu', 'Faxinalenses', 'Pescadores Artesanais', 'Marisqueiras', 'Ribeirinhos', 'Vardejeiros', 'Caiçaras', 'Praieiros', 'Sertanejos', 'Jangadeiros', 'Ciganos', 'Açorianos', 'Campeiros', 'Varzanteiros', 'Pantaneiros', 'Geraizeiros', 'Caatingueiros', 'Retireiros do Araguaia', 'Ilhéus', 'Morroquianos', 'Catadores de Mangaba', 'Extrativistas Costeiros e Marihos', 'Extrativistas', 'Fundo e fecho de pasto', 'Cipozeiros', 'Cablocos', 'Benzendeiros', 'Apanhadores de Terreiro/Povos e Comunidades de Matriz Africana', 'Raizeiros', 'Não', 'Outro'],
            'validations' => [
                'required' => 'Campo obrigatório'
            ]
        ));

        $this->registerAgentMetadata('territorio_povos_comunidades_organizacao_outro', array(
            'label' => 'Outro qual? (caso não se aplique, insira "NSA - Não Se Aplica")',
            'type' => 'text',
            'validations' => [
                'required' => 'Campo obrigatório'
            ]
        ));

        $this->registerAgentMetadata('infraestrutura_presente_organizacao', array(
            'label' => 'Qual a infraestrutura presente na organização?',
            'type' => 'multiselect',
            'options' => ['Energia elétrica', 'Água encanada', 'Telefone fixo', 'Internet banda larga', 'Celular', 'Outras'],
            'validations' => [
                'required' => 'Campo obrigatório'
            ]
        ));

        $this->registerAgentMetadata('infraestrutura_presente_organizacao_outra', array(
            'label' => 'Outras quais? (caso não se aplique, insira "NSA - Não Se Aplica")?',
            'type' => 'text',
            'validations' => [
                'required' => 'Campo obrigatório'
            ]
        ));

        $this->registerAgentMetadata('linguagens_artisticas_organizacao', array(
            'label' => 'Assinale as linguagens artísticas que são desenvolvidas pela organização',
            'type' => 'multiselect',
            'options' => ['Música', 'Manifestações populares', 'Audiovisual', 'Teatro', 'Literatura', 'Artesanato', 'Dança', 'Artes Plásticas', 'Fotografia', 'Cineclube', 'Artes Gráficas', 'Artes Visuais', 'Cinema', 'Arte Circense'],
            'validations' => [
                'required' => 'Campo obrigatório'
            ]
        ));

        $this->registerAgentMetadata('atuacao_tematica_organizacao', array(
            'label' => 'Assinale atuação temática prioritária da organização:',
            'type' => 'select',
            'options' => ['Culturas Indígenas e Mãe Terra', 'Povos e Comunidades Tradicionais de Matriz Africana', 'Culturas Populares e Tradicionais', 'Cultura Digital, Comunicação e Mídia Livre', 'Patrimônio e Memória', 'Linguagens Artísticas', 'Livro, Leitura e Literatura', 'Gênero, Diversidade e Direitos Humanos', 'Acessibilidade Cultural e Equidade', 'Economia da Cultura, Solidária e Criativa', 'Cultura Infância', 'Formação e Educação Cultural', 'Territórios Rurais e Cultura Alimentar', 'Cultura Urbana, Direito à Cidade e Juventudes', 'Cultura, Territórios de Fronteira e Integração Latinoamericana', 'Não há'],
            'validations' => [
                'required' => 'Campo obrigatório'
            ]
        ));

        $this->registerAgentMetadata('atuacao_tematica_secundarias_organizacao', array(
            'label' => 'Assinale as atuações temáticas secundárias:',
            'type' => 'multiselect',
            'options' => ['Culturas Indígenas e Mãe Terra', 'Povos e Comunidades Tradicionais de Matriz Africana', 'Culturas Populares e Tradicionais', 'Cultura Digital', 'Comunicação e Mídia Livre', 'Patrimônio e Memória', 'Linguagens Artísticas', 'Livro, Leitura e Literatura', 'Gênero, Diversidade e Direitos Humanos', 'Acessibilidade Cultural e Equidade', 'Economia da Cultura, Solidária e Criativa', 'Cultura Infância', 'Formação e Educação Cultural', 'Territórios Rurais e Cultura Alimentar', 'Cultura Urbana, Direito à Cidade e Juventudes', 'Cultura, Territórios de Fronteira e Integração Latinoamericana', 'Não há'],
            'validations' => [
                'required' => 'Campo obrigatório'
            ]
        ));

        $this->registerAgentMetadata('publico_atendido_organizacao', array(
            'label' => 'Público atendido pela organização',
            'type' => 'multiselect',
            'options' => ['Crianças', 'Adolescentes', 'Jovens', 'Adultos', 'Idosos'],
            'validations' => [
                'required' => 'Campo obrigatório'
            ]
        ));

        $this->registerAgentMetadata('realiza_atividades_organizacao', array(
            'label' => 'Onde a organização realiza as atividades?',
            'type' => 'multiselect',
            'options' => ['Sede própria', 'Escolas e espaços parceiros', 'Espaços públicos', 'Outros'],
            'validations' => [
                'required' => 'Campo obrigatório'
            ]
        ));

        $this->registerAgentMetadata('realiza_atividades_organizacao_outro', array(
            'label' => 'Outros quais? (caso não se aplique, insira "NSA - Não Se Aplica")?',
            'type' => 'text',
            'validations' => [
                'required' => 'Campo obrigatório'
            ]
        ));

        $this->registerAgentMetadata('sede_propria_condicao_organizacao', array(
            'label' => 'Caso tenha sede própria, qual a condição do imóvel onde se situa a organização?',
            'type' => 'select',
            'options' => ['cedido pro empresa privada', 'cedido por instituição de educação privada', 'cedido por pessoa física', 'alugado', 'cedido por ONG', 'próprio', 'cedido por instituição de educação pública', 'cedido por instituição de classe', 'cedido por órgão público', 'Outros…'],
            'validations' => [
                'required' => 'Campo obrigatório'
            ]
        ));

        $this->registerAgentMetadata('sede_propria_condicao_organizacao_outro', array(
            'label' => 'Outros quais? (caso não se aplique, insira "NSA - Não Se Aplica")?',
            'type' => 'text',
            'validations' => [
                'required' => 'Campo obrigatório'
            ]
        ));

        $this->registerAgentMetadata('sede_propria_dificuldades_organizacao', array(
            'label' => 'Se em sede própria, assinale as dificuldades de acesso a organização:',
            'type' => 'multiselect',
            'options' => ['Não há dificuldade', 'Local muito violento', 'Não há transporte', 'Transporte caro'],
            'validations' => [
                'required' => 'Campo obrigatório'
            ]
        ));

        $this->registerAgentMetadata('sede_propria_espacos_organizacao', array(
            'label' => 'Caso tenha sede própria, quais espaços ela oferece?',
            'type' => 'multiselect',
            'options' => ['Sala de Aula', 'Sala de Projeção', 'Laboratório de Informática', 'Biblioteca', 'Sala de exposição', 'Auditório', 'Ateliêr', 'Palco tablado', 'Teatro/Arena', 'Estúdio de Música', 'Quadra de esportes', 'Brinquedoteca', 'Discoteca', 'Laboratório de fotografia', 'Camping', 'Alojamento', 'Horta', 'Área aberta', 'Sala de atendimento', 'Espaço de memória/Centro de Memória/Museu Rural/Ecomuseu', 'Outros'],
            'validations' => [
                'required' => 'Campo obrigatório'
            ]
        ));

        $this->registerAgentMetadata('sede_propria_espacos_organizacao_outro', array(
            'label' => 'Outros quais? (caso não se aplique, insira "NSA - Não Se Aplica")?',
            'type' => 'text',
            'validations' => [
                'required' => 'Campo obrigatório'
            ]
        ));

        $this->registerAgentMetadata('itens_presentes_organizacao', array(
            'label' => 'Assinale os itens presentes na organização',
            'type' => 'multiselect',
            'options' => ['Instrumentos musicais', 'Equipamento de Som', 'Mesa de som', 'Leitor de DVD/vhs', 'Televisão ', 'Câmera filmadora', 'Projetores', 'Desktops', 'Laptops', 'Servidores de internet', 'Retroprojetores/datashow', 'Câmeras fotográficas', 'Equipamento de iluminação', 'Equipamento de circo', 'Máquinas de Costura', 'Computador', 'Impressora', 'Quadro branco/verde/preto', 'Outros'],
            'validations' => [
                'required' => 'Campo obrigatório'
            ]
        ));

        $this->registerAgentMetadata('itens_presentes_organizacao_outro', array(
            'label' => 'Outros quais? (caso não se aplique, insira "NSA - Não Se Aplica")?',
            'type' => 'text',
            'validations' => [
                'required' => 'Campo obrigatório'
            ]
        ));

        $this->registerAgentMetadata('origem_recursos_organizacao', array(
            'label' => 'Qual a origem dos recursos da organização?',
            'type' => 'multiselect',
            'options' => ['Receita de mensalidade do público atendido pelo Ponto', 'Doações de igrejas', 'Organismo de fomento internacional (ONU, Bird, Banco Mundial, Cida, etc.)', 'Recursos de governos estrangeiros', 'Multinacionais', 'Banco de fomento nacional (BNDS, BNB, Banco do Brasil, Caixa)', 'Fundos de incentivo a cultura', 'Sistema S (Sebrae, Senai, Sesi, Senac, Sesc)', 'ONGs/fundações internacionais', 'Empresas públicas nacionais', 'Outros programas do MinC', 'Recursos do governo federal (que não do MInC)', 'ONGs/fundações nacionais', 'Editais/Lei de incentivo fiscal', 'Recursos de governos estaduais', 'Empresas privadas nacionais', 'Ganhos de aplicação financeira', 'Doações de pessoas físicas', 'Recursos de governos municipais', 'Prêmios', 'Receita de produtos e serviços produzidos pela organização (inclui receita de bilheteria de eventos)', 'Outros'],
            'validations' => [
                'required' => 'Campo obrigatório'
            ]
        ));

        $this->registerAgentMetadata('origem_recursos_organizacao_outro', array(
            'label' => 'Outros quais? (caso não se aplique, insira "NSA - Não Se Aplica")?',
            'type' => 'text',
            'validations' => [
                'required' => 'Campo obrigatório'
            ]
        ));

        $this->registerAgentMetadata('despesas_organizacao', array(
            'label' => 'Assinale quais despesas fazem parte dos gastos da organização *',
            'type' => 'multiselect',
            'options' => ['Pagamento de pessoal', 'Aluguel de imóvel', 'Energia/Água/Gás', 'Telefone/internet', 'Verba para divulgação', 'Transporte e combustível', 'Manutenção de máquinas', 'Material de escritório', 'Alimentação', 'Bolsa ou auxílio para público', 'Viagens', 'Outros'],
            'validations' => [
                'required' => 'Campo obrigatório'
            ]
        ));

        $this->registerAgentMetadata('despesas_organizacao_outro', array(
            'label' => 'Outros quais? (caso não se aplique, insira "NSA - Não Se Aplica")?',
            'type' => 'text',
            'validations' => [
                'required' => 'Campo obrigatório'
            ]
        ));

        $this->registerAgentMetadata('medidas_acessibilidade_organizacao', array(
            'label' => 'A organização/coletivo cultural adota medidas de acessibilidade em suas atividades e espaços? Se sim, em quais dimensões as medidas são aplicadas? (Selecione todas as que se aplicam)',
            'type' => 'multiselect',
            'options' => ['Acessibilidade física (ex.: rampas, elevadores, banheiros acessíveis)', 'Acessibilidade comunicacional (ex.: intérpretes de Libras, legendas, materiais em braille)', 'Acessibilidade atitudinal (ex.: treinamentos de sensibilização, políticas inclusivas)', 'Acessibilidade digital (ex.: sites acessíveis, aplicativos com suporte para tecnologias assistivas)', 'Acessibilidade programática (ex.: adequação de horários, adaptação de conteúdo)', 'Acessibilidade metodológica (ex.: adaptação de métodos de ensino, abordagens pedagógicas inclusivas)', 'Acessibilidade natural (ex.: trilhas acessíveis, áreas de lazer adaptadas)', 'Não possui medidas de acessibilidade', 'Outros'],
            'validations' => [
                'required' => 'Campo obrigatório'
            ]
        ));

        $this->registerAgentMetadata('medidas_acessibilidade_organizacao_outro', array(
            'label' => 'Outros quais? (caso não se aplique, insira "NSA - Não Se Aplica")?',
            'type' => 'text',
            'validations' => [
                'required' => 'Campo obrigatório'
            ]
        ));

        $this->registerAgentMetadata('participou_atividade_rnpcmr_organizacao', array(
            'label' => 'Sua organização já participou de alguma atividade da Rede Nacional de Pontos de Cultura e Memória Rurais?',
            'type' => 'select',
            'options' => ['Sim', 'Não'],
            'validations' => [
                'required' => 'Campo obrigatório'
            ]
        ));

        $this->registerAgentMetadata('participou_atividade_rnpcmr_organizacao_se_sim', array(
            'label' => 'Se sim, quais?',
            'type' => 'text',
            'validations' => [
                'required' => 'Campo obrigatório'
            ]
        ));
        // Diagnóstico - Organização

        // Preservacao da memoria cultural
        $this->registerAgentMetadata('atividades_pre_memo_cult', array(
            'label' => 'A sua organização realiza atividades que visam a preservação da memória cultural local?',
            'type' => 'select',
            'options' => ['Sim', 'Não'],
            'validations' => [
                'required' => 'Campo obrigatório'
            ]
        ));
        $this->registerAgentMetadata('atividades_pre_memo_cult_se_sim', array(
            'label' => 'Se sim, quais?',
            'type' => 'text',
            'validations' => [
                'required' => 'Campo obrigatório'
            ]
        ));
        $this->registerAgentMetadata('acervo_ou_documentacao', array(
            'label' => 'Existe algum acervo ou documentação sobre a cultura local que a organização mantém?',
            'type' => 'select',
            'options' => ['Sim', 'Não'],
            'validations' => [
                'required' => 'Campo obrigatório'
            ]
        ));
        $this->registerAgentMetadata('eventos_ou_atividades', array(
            'label' => 'Que tipo de eventos ou atividades culturais são realizados na sua organização para promover a memória cultural?',
            'type' => 'text',
            'validations' => [
                'required' => 'Campo obrigatório'
            ]
        ));
        $this->registerAgentMetadata('criacao_preservacao_novas_manifestacoes_culturais', array(
            'label' => 'A sua organização envolve a comunidade na criação e preservação de novas manifestações culturais?',
            'type' => 'select',
            'options' => ['Sim', 'Não'],
            'validations' => [
                'required' => 'Campo obrigatório'
            ]
        ));
        $this->registerAgentMetadata('criacao_preservacao_novas_manifestacoes_culturais_se_sim', array(
            'label' => 'Se sim, como isso acontece?',
            'type' => 'text',
            'validations' => [
                'required' => 'Campo obrigatório'
            ]
        ));
        // Preservacao da memoria cultural

        // Acesso a agua
        $this->registerAgentMetadata('principal_fonte_abastecimento', array(
            'label' => 'Qual é a principal fonte de abastecimento de água utilizada pela sua comunidade? (poços, rios, cisternas, sistema de abastecimento público, etc.)',
            'type' => 'text',
            'validations' => [
                'required' => 'Campo obrigatório'
            ]
        ));
        $this->registerAgentMetadata('facilidade_acesso_agua_potavel', array(
            'label' => 'Há facilidade de acesso à água potável para todos os moradores da sua comunidade?',
            'type' => 'select',
            'options' => ['Sim', 'Não'],
            'validations' => [
                'required' => 'Campo obrigatório'
            ]
        ));
        $this->registerAgentMetadata('facilidade_acesso_agua_potavel_se_nao', array(
            'label' => 'Se não, quais são os principais obstáculos enfrentados?',
            'type' => 'text',
            'validations' => [
                'required' => 'Campo obrigatório'
            ]
        ));
        $this->registerAgentMetadata('quantidade_agua_disponivel_suficiente', array(
            'label' => 'A quantidade de água disponível é suficiente para atender às necessidades da comunidade? (para consumo, agricultura, atividades domésticas, etc.)',
            'type' => 'select',
            'options' => ['Sim', 'Não'],
            'validations' => [
                'required' => 'Campo obrigatório'
            ]
        ));
        $this->registerAgentMetadata('iniciativas_coleta_armazenamento_chuva', array(
            'label' => 'Há iniciativas na sua comunidade para a coleta e armazenamento de água da chuva?',
            'type' => 'select',
            'options' => ['Sim', 'Não'],
            'validations' => [
                'required' => 'Campo obrigatório'
            ]
        ));
        $this->registerAgentMetadata('iniciativas_coleta_armazenamento_chuva_se_sim', array(
            'label' => 'Se sim, quais?',
            'type' => 'text',
            'validations' => [
                'required' => 'Campo obrigatório'
            ]
        ));
        $this->registerAgentMetadata('lidar_escassez_agua', array(
            'label' => 'Como a comunidade lida com a escassez de água em períodos de seca?',
            'type' => 'text',
            'validations' => [
                'required' => 'Campo obrigatório'
            ]
        ));
        // Acesso a agua

        // Saneamento basico
        $this->registerAgentMetadata('saneamento_basico_organizacao', array(
            'label' => 'Há saneamento básico na sua organização?',
            'type' => 'select',
            'options' => ['Sim', 'Não'],
            'validations' => [
                'required' => 'Campo obrigatório'
            ]
        ));
        $this->registerAgentMetadata('saneamento_basico_comunidade', array(
            'label' => 'Há saneamento básico na sua comunidade?',
            'type' => 'select',
            'options' => ['Sim', 'Não'],
            'validations' => [
                'required' => 'Campo obrigatório'
            ]
        ));
        // Saneamento basico

        // Qualidade da agua
        $this->registerAgentMetadata('agua_comunidade_frequentemente_testada', array(
            'label' => 'A água disponível na sua comunidade é frequentemente testada quanto à sua qualidade?',
            'type' => 'select',
            'options' => ['Sim', 'Não'],
            'validations' => [
                'required' => 'Campo obrigatório'
            ]
        ));
        $this->registerAgentMetadata('agua_comunidade_frequentemente_testada_se_sim', array(
            'label' => 'Se sim, quais foram os resultados mais recentes?',
            'type' => 'text',
            'validations' => [
                'required' => 'Campo obrigatório'
            ]
        ));
        $this->registerAgentMetadata('problemas_saude_devido_qualidade_agua', array(
            'label' => 'Quais problemas de saúde, se houver, foram associados à qualidade da água na sua região?',
            'type' => 'text',
            'validations' => [
                'required' => 'Campo obrigatório'
            ]
        ));
        $this->registerAgentMetadata('campanhas_conscientizacao_importancia_qualidade_agua', array(
            'label' => 'Existem campanhas de conscientização na comunidade sobre a importância da qualidade da água?',
            'type' => 'select',
            'options' => ['Sim', 'Não'],
            'validations' => [
                'required' => 'Campo obrigatório'
            ]
        ));
        $this->registerAgentMetadata('campanhas_conscientizacao_importancia_qualidade_agua_se_sim', array(
            'label' => 'Se sim, como elas são conduzidas?',
            'type' => 'text',
            'validations' => [
                'required' => 'Campo obrigatório'
            ]
        ));
        $this->registerAgentMetadata('medidas_tomadas_organizacao_qualidade_agua', array(
            'label' => 'Que medidas são tomadas pela sua organização para melhorar a qualidade da água na comunidade?',
            'type' => 'text',
            'validations' => [
                'required' => 'Campo obrigatório'
            ]
        ));
        // Qualidade da agua

        // Uso do solo e praticas agricolas
        $this->registerAgentMetadata('principal_tipo_cultivo_regiao', array(
            'label' => 'Qual é o principal tipo de cultivo realizado na sua região? (monocultivos, policultivos, etc.)',
            'type' => 'text',
            'validations' => [
                'required' => 'Campo obrigatório'
            ]
        ));
        $this->registerAgentMetadata('praticas_agricultura_sustentavel_aplicadas', array(
            'label' => 'Existem práticas de agricultura sustentável sendo aplicadas?',
            'type' => 'select',
            'options' => ['Sim', 'Não'],
            'validations' => [
                'required' => 'Campo obrigatório'
            ]
        ));
        $this->registerAgentMetadata('praticas_agricultura_sustentavel_aplicadas_se_sim', array(
            'label' => 'Se sim, quais?',
            'type' => 'text',
            'validations' => [
                'required' => 'Campo obrigatório'
            ]
        ));
        $this->registerAgentMetadata('uso_agrotoxicos', array(
            'label' => 'O uso de agrotóxicos é comum na sua região?',
            'type' => 'select',
            'options' => ['Sim', 'Não'],
            'validations' => [
                'required' => 'Campo obrigatório'
            ]
        ));
        $this->registerAgentMetadata('uso_agrotoxicos_se_sim', array(
            'label' => 'Se sim, quais são os principais produtos utilizados?',
            'type' => 'text',
            'validations' => [
                'required' => 'Campo obrigatório'
            ]
        ));
        $this->registerAgentMetadata('perceber_efeitos_uso_agrotoxico', array(
            'label' => 'Como a comunidade percebe os efeitos do uso de agrotóxicos na saúde e no meio ambiente?',
            'type' => 'text',
            'validations' => [
                'required' => 'Campo obrigatório'
            ]
        ));
        $this->registerAgentMetadata('criacao_gados', array(
            'label' => 'A criação de gado é uma prática na sua comunidade?',
            'type' => 'select',
            'options' => ['Sim', 'Não'],
            'validations' => [
                'required' => 'Campo obrigatório'
            ]
        ));
        $this->registerAgentMetadata('criacao_gados_se_sim', array(
            'label' => 'Se sim, quais impactos essa atividade traz para o solo e a água?',
            'type' => 'text',
            'validations' => [
                'required' => 'Campo obrigatório'
            ]
        ));
        // Uso do solo e praticas agricolas

        // Seguranca alimentar
        $this->registerAgentMetadata('possui_espaco_producao_alimentos', array(
            'label' => 'A organização possui um espaço (quintal ou terreiro) dedicado à produção de alimentos?',
            'type' => 'select',
            'options' => ['Sim', 'Não'],
            'validations' => [
                'required' => 'Campo obrigatório'
            ]
        ));
        $this->registerAgentMetadata('possui_espaco_producao_alimentos_se_sim', array(
            'label' => 'Se sim, quais tipos de alimentos  mais cultiva?',
            'type' => 'text',
            'validations' => [
                'required' => 'Campo obrigatório'
            ]
        ));
        $this->registerAgentMetadata('praticas_agroecologia_utiliza_producao', array(
            'label' => 'Quais práticas de agroecologia  utiliza em sua produção? (Ex.: compostagem, rotação de culturas, uso de insumos orgânicos)',
            'type' => 'text',
            'validations' => [
                'required' => 'Campo obrigatório'
            ]
        ));
        $this->registerAgentMetadata('participou_iniciativa_comercializacao_alimentos_governo', array(
            'label' => 'Já participou de alguma iniciativa de comercialização de alimentos para programas de governo, como o Programa de Aquisição de Alimentos (PAA)?',
            'type' => 'select',
            'options' => ['Sim', 'Não'],
            'validations' => [
                'required' => 'Campo obrigatório'
            ]
        ));
        $this->registerAgentMetadata('participou_iniciativa_comercializacao_alimentos_governo_se_sim', array(
            'label' => 'Se sim, como foi sua experiência?',
            'type' => 'text',
            'validations' => [
                'required' => 'Campo obrigatório'
            ]
        ));
        $this->registerAgentMetadata('canais_vendas_produtos', array(
            'label' => 'Como você avalia os canais de venda dos seus produtos?',
            'type' => 'text',
            'validations' => [
                'required' => 'Campo obrigatório'
            ]
        ));
        $this->registerAgentMetadata('sente_suficientes_garantir_renda_justo', array(
            'label' => 'Você sente que eles são suficientes para garantir uma renda justa?',
            'type' => 'select',
            'options' => ['Sim', 'Não'],
            'validations' => [
                'required' => 'Campo obrigatório'
            ]
        ));
        $this->registerAgentMetadata('hortas_comunitarias', array(
            'label' => 'Sua comunidade possui hortas comunitárias?',
            'type' => 'select',
            'options' => ['Sim', 'Não'],
            'validations' => [
                'required' => 'Campo obrigatório'
            ]
        ));
        $this->registerAgentMetadata('hortas_comunitarias_se_sim', array(
            'label' => 'Se sim, como elas são geridas e que papel desempenham na segurança alimentar local?',
            'type' => 'text',
            'validations' => [
                'required' => 'Campo obrigatório'
            ]
        ));
        $this->registerAgentMetadata('hortas_comunitarias_se_sim_segundo', array(
            'label' => 'Se sim, quais benefícios você enxerga nas hortas comunitárias para a sua comunidade?',
            'type' => 'text',
            'validations' => [
                'required' => 'Campo obrigatório'
            ]
        ));
        $this->registerAgentMetadata('feiras_livres', array(
            'label' => 'Você participa de feiras livres ou feiras de agricultores na sua região?',
            'type' => 'select',
            'options' => ['Sim', 'Não'],
            'validations' => [
                'required' => 'Campo obrigatório'
            ]
        ));
        $this->registerAgentMetadata('feiras_livres_se_sim', array(
            'label' => 'Se sim, como é a experiência de comercializar/localizar alimentos aí?',
            'type' => 'text',
            'validations' => [
                'required' => 'Campo obrigatório'
            ]
        ));
        $this->registerAgentMetadata('iniciativas_colaborativas_producao_consumo', array(
            'label' => 'Você conhece ou participa de iniciativas colaborativas de produçao e consumo como CSA (Comunidade que Sustenta a Agricultura) ou outras?',
            'type' => 'select',
            'options' => ['Sim', 'Não'],
            'validations' => [
                'required' => 'Campo obrigatório'
            ]
        ));
        $this->registerAgentMetadata('iniciativas_colaborativas_producao_consumo_se_sim', array(
            'label' => 'Se sim, quais e como é a relação entre consumidores e produtores nesse modelo?',
            'type' => 'text',
            'validations' => [
                'required' => 'Campo obrigatório'
            ]
        ));
        $this->registerAgentMetadata('principais_desafios_seguranca_alimentar', array(
            'label' => 'Quais são os principais desafios que você enfrenta em relação à segurança alimentar na sua comunidade?',
            'type' => 'text',
            'validations' => [
                'required' => 'Campo obrigatório'
            ]
        ));
        $this->registerAgentMetadata('apoio_recurso_melhorar_producao_comercializacao', array(
            'label' => 'Que tipo de apoio ou recursos seriam mais úteis para melhorar a produção e comercialização de alimentos na sua região?',
            'type' => 'text',
            'validations' => [
                'required' => 'Campo obrigatório'
            ]
        ));
        // Seguranca alimentar

        // Questoes fundiarias e conflitos socioambientais
        $this->registerAgentMetadata('conflitos_relacionados_terra', array(
            'label' => 'Existem conflitos relacionados à terra no seu território?',
            'type' => 'select',
            'options' => ['Sim', 'Não'],
            'validations' => [
                'required' => 'Campo obrigatório'
            ]
        ));
        $this->registerAgentMetadata('conflitos_relacionados_terra_se_sim', array(
            'label' => 'Se sim, com que grupos?',
            'type' => 'text',
            'validations' => [
                'required' => 'Campo obrigatório'
            ]
        ));
        $this->registerAgentMetadata('poder_publico_lidado_conflitos', array(
            'label' => 'Como o poder público tem lidado com as questões fundiárias e os conflitos socioambientais?',
            'type' => 'text',
            'validations' => [
                'required' => 'Campo obrigatório'
            ]
        ));
        $this->registerAgentMetadata('enfrentou_conflitos_vizinhos_empresas', array(
            'label' => 'A sua comunidade já enfrentou conflitos com vizinhos ou empresas em relação ao uso da terra?',
            'type' => 'select',
            'options' => ['Sim', 'Não'],
            'validations' => [
                'required' => 'Campo obrigatório'
            ]
        ));
        $this->registerAgentMetadata('enfrentou_conflitos_vizinhos_empresas_se_sim', array(
            'label' => 'Se sim, como foram resolvidos?',
            'type' => 'text',
            'validations' => [
                'required' => 'Campo obrigatório'
            ]
        ));
        $this->registerAgentMetadata('apoio_resistencia_grandes_empreendimentos', array(
            'label' => 'Há apoio ou resistência da comunidade em relação a grandes empreendimentos na região?',
            'type' => 'select',
            'options' => ['Sim', 'Não'],
            'validations' => [
                'required' => 'Campo obrigatório'
            ]
        ));
        $this->registerAgentMetadata('apoio_resistencia_grandes_empreendimentos_se_sim', array(
            'label' => 'Se sim, quais são as principais preocupações?   ',
            'type' => 'text',
            'validations' => [
                'required' => 'Campo obrigatório'
            ]
        ));
        // Questoes fundiarias e conflitos socioambientais

        // Colaboracao e redes
        $this->registerAgentMetadata('rede_parceria_outras_instituicoes', array(
            'label' => 'A organização faz parte de alguma rede ou parceria com outras instituições?',
            'type' => 'select',
            'options' => ['Sim', 'Não'],
            'validations' => [
                'required' => 'Campo obrigatório'
            ]
        ));
        $this->registerAgentMetadata('rede_parceria_outras_instituicoes_se_sim', array(
            'label' => 'Se sim, quais?',
            'type' => 'text',
            'validations' => [
                'required' => 'Campo obrigatório'
            ]
        ));
        $this->registerAgentMetadata('principais_desafios_integrar_redes_parcerias', array(
            'label' => 'Quais são os principais desafios que a sua organização enfrenta ao tentar se integrar em redes ou parcerias?',
            'type' => 'text',
            'validations' => [
                'required' => 'Campo obrigatório'
            ]
        ));
        $this->registerAgentMetadata('importancia_colaboracoes_desenvolvimento_cultural', array(
            'label' => 'Como você enxerga a importância dessas colaborações para o desenvolvimento cultural e ambiental na região?',
            'type' => 'text',
            'validations' => [
                'required' => 'Campo obrigatório'
            ]
        ));
        $this->registerAgentMetadata('colaboracoes_outras_instituicoes_trazer_beneficios', array(
            'label' => 'De que maneira as colaborações com outras instituições podem trazer benefícios diretos para a comunidade?',
            'type' => 'text',
            'validations' => [
                'required' => 'Campo obrigatório'
            ]
        ));
        // Colaboracao e redes

        // Instancias de participacao
        $this->registerAgentMetadata('conselho_comite_relacionados_cultura', array(
            'label' => 'Você faz parte de algum conselho ou comitê na sua região que trate de assuntos relacionados à cultura, ruralidade ou cultura alimentar?',
            'type' => 'select',
            'options' => ['Sim', 'Não'],
            'validations' => [
                'required' => 'Campo obrigatório'
            ]
        ));
        $this->registerAgentMetadata('conselho_comite_relacionados_cultura_se_sim', array(
            'label' => 'Se sim, qual?',
            'type' => 'text',
            'validations' => [
                'required' => 'Campo obrigatório'
            ]
        ));
        $this->registerAgentMetadata('avalia_importancia_participacao_instancias', array(
            'label' => 'Como você avalia a importância da sua participação nessas instâncias? De que maneira isso influencia as decisões locais?',
            'type' => 'text',
            'validations' => [
                'required' => 'Campo obrigatório'
            ]
        ));
        $this->registerAgentMetadata('comunidade_participa_foruns_encontros_discutir_cultura', array(
            'label' => 'Sua comunidade participa de fóruns ou encontros regulares para discutir temas relacionados à cultura e agricultura?',
            'type' => 'select',
            'options' => ['Sim', 'Não'],
            'validations' => [
                'required' => 'Campo obrigatório'
            ]
        ));
        $this->registerAgentMetadata('comunidade_participa_foruns_encontros_discutir_cultura_se_sim', array(
            'label' => 'Se sim, como esses encontros são organizados?',
            'type' => 'text',
            'validations' => [
                'required' => 'Campo obrigatório'
            ]
        ));
        $this->registerAgentMetadata('principais_discussoes_decisoes_participacao_foruns', array(
            'label' => 'Quais foram as principais discussões ou decisões resultantes de sua participação em fóruns? Você sentiu que sua voz foi ouvida?',
            'type' => 'text',
            'validations' => [
                'required' => 'Campo obrigatório'
            ]
        ));
        $this->registerAgentMetadata('acesso_informacoes_sobre_instancias_disponiveis_regiao', array(
            'label' => 'Você tem acesso a informações sobre as instâncias de participação disponíveis em sua região?',
            'type' => 'select',
            'options' => ['Sim', 'Não'],
            'validations' => [
                'required' => 'Campo obrigatório'
            ]
        ));
        $this->registerAgentMetadata('acesso_informacoes_sobre_instancias_disponiveis_regiao_se_sim', array(
            'label' => 'Se sim, como você se informa sobre essas oportunidades?',
            'type' => 'text',
            'validations' => [
                'required' => 'Campo obrigatório'
            ]
        ));
        $this->registerAgentMetadata('principais_lacunas_informacao_apoio_esferas', array(
            'label' => 'Quais seriam, na sua opinião, as principais lacunas de informação ou apoio que dificultam uma maior participação nas esferas estadual, municipal e federal?',
            'type' => 'text',
            'validations' => [
                'required' => 'Campo obrigatório'
            ]
        ));
        $this->registerAgentMetadata('mudanca_significativa_politicas_publicas_cultura', array(
            'label' => 'Você percebe alguma mudança significativa nas políticas públicas relacionadas à cultura e ruralidade devido à atuação de conselhos ou fóruns na sua comunidade?',
            'type' => 'select',
            'options' => ['Sim', 'Não'],
            'validations' => [
                'required' => 'Campo obrigatório'
            ]
        ));
        $this->registerAgentMetadata('algum_exemplo_participacao_resultou_mudanca', array(
            'label' => 'Existe algum exemplo em que sua participação resultou em uma mudança prática ou melhoria na sua comunidade?',
            'type' => 'text',
            'validations' => [
                'required' => 'Campo obrigatório'
            ]
        ));
        $this->registerAgentMetadata('sugestoes_aumentar_participacao', array(
            'label' => 'Que sugestões você teria para aumentar a participação da comunidade nas instâncias estaduais e municipais?',
            'type' => 'text',
            'validations' => [
                'required' => 'Campo obrigatório'
            ]
        ));
        $this->registerAgentMetadata('imagina_fortalecimento_instancias_beneficiar_cultura', array(
            'label' => 'Como você imagina que o fortalecimento dessas instâncias poderia beneficiar a cultura alimentar e as práticas rurais na sua região?',
            'type' => 'text',
            'validations' => [
                'required' => 'Campo obrigatório'
            ]
        ));
        // Instancias de participacao
    }

    static function _getTexts()
    {
        $app = App::i();

        return [
            'home: agents' => 'Teste'
        ];
    }

    protected function _publishAssets()
    {

        // $this->jsObject['assets']['logo-instituicao'] = $this->asset('img/logo-instituicao.png', false);

        // $this->enqueueScript('app', 'hide-fields', 'js/hide-fields.js');
    }
}
