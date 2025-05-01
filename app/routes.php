<?php

return [
    '/'              => [
        'controller' => 'main',
        'action'     => 'main'
    ],
    '/film'          => [
        'controller' => 'main',
        'action'     => 'movie'
    ],
    '/regisztracio'  => [
        'controller' => 'user',
        'action'     => 'registration'
    ],
    '/bejelentkezes' => [
        'controller' => 'user',
        'action'     => 'login'
    ],
    '/kijelentkezes' => [
        'controller' => 'user',
        'action'     => 'logout'
    ],
];
