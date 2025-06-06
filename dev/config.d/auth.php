<?php

return [
    //'auth.provider' => 'Fake',
    'auth.provider' => '\MultipleLocalAuth\Provider',
    'auth.config' => [
        'salt' => env('AUTH_SALT', null),

        'timeout' => '24 hours',

        //Habilita registro e login através do CPF
        'enableLoginByCPF' => true,
            
        //apelido do metadata que será salvo o campo CPF
        'metadataFieldCPF' => 'documento',
        
        //Regra para saber se o usuario deve ou não confiar o email para poder utilizar o sistema
        'userMustConfirmEmailToUseTheSystem' => false,

        //Regra de força de senha - Ter no mínimo 1 letra maiúscula
        'passwordMustHaveCapitalLetters' => true,

        //Regra de força de senha - Ter no mínimo 1 letra minúscula
        'passwordMustHaveLowercaseLetters' => true,

        //Regra de força de senha - Ter no mínimo 1 caractere especial
        'passwordMustHaveSpecialCharacters' => true,

        //Regra de força de senha - Ter no mínimo 1 caractere numérico
        'passwordMustHaveNumbers' => true,

        //Regra de força de senha - Ter no mínimo n caracteres
        'minimumPasswordLength' => 6,
        
        //Configuração de GOOGLE Recaptcha
        'google-recaptcha-secret' => '6LeIxAcTAAAAAGG-vFI1TnRWxMZNFuojJ4WifJWe',
        'google-recaptcha-sitekey' => '6LeIxAcTAAAAAJcZVRqyHh71UMIEGNQ_MXjiZKhI',

        //Tempo da sessao do usuario em segundos
        'sessionTime' => 7200,

        //Limite de tentativas não sucedidas de login antes de bloquear o usuario por X minutos
        'numberloginAttemp' => '5', 

        //Tempo de bloqueio do usuario em segundos, após romper limites de tentativas não sucedidas
        'timeBlockedloginAttemp' => '900', 
        
        'strategies' => [
            'Facebook' => [
                'app_id' => env('AUTH_FACEBOOK_APP_ID', null),
                'app_secret' => env('AUTH_FACEBOOK_APP_SECRET', null),
                'scope' => env('AUTH_FACEBOOK_SCOPE', 'email'),
            ],
            'LinkedIn' => [
                'api_key' => env('AUTH_LINKEDIN_API_KEY', null),
                'secret_key' => env('AUTH_LINKEDIN_SECRET_KEY', null),
                'redirect_uri' => '/autenticacao/linkedin/oauth2callback',
                'scope' => env('AUTH_LINKEDIN_SCOPE', 'r_emailaddress')
            ],
            'Google' => [
                'client_id' => env('AUTH_GOOGLE_CLIENT_ID', null),
                'client_secret' => env('AUTH_GOOGLE_CLIENT_SECRET', null),
                'redirect_uri' => '/autenticacao/google/oauth2callback',
                'scope' => env('AUTH_GOOGLE_SCOPE', 'email'),
            ],
            'Twitter' => [
                'app_id' => env('AUTH_TWITTER_APP_ID', null),
               'app_secret' => env('AUTH_TWITTER_APP_SECRET', null),
            ],
        ]
    ]
];