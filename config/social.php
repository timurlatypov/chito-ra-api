<?php

return [
    'providers' => [
        'vkontakte' => [
            'name'   => 'Вконтакте',
            'scopes' => [],
        ],
        'yandex'    => [
            'name'   => 'Яндекс',
            'scopes' => [],
        ],
        'facebook'  => [
            'name'   => 'Facebook',
            'scopes' => [
                'email',
                'user_birthday',
                'user_location',
                'user_gender',
            ],
        ],
        'google'    => [
            'name'   => 'Google Plus',
            'scopes' => [],
        ],
        'mailru'    => [
            'name'   => 'Mail.ru',
            'scopes' => [],
        ],
    ],
];
