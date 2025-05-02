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
    '/kapcsolat'     => [
        'controller' => 'contact',
        'action'     => 'main'
    ],
    '/uzenetek'      => [
        'controller' => 'messages',
        'action'     => 'main'
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
