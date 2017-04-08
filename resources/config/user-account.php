<?php

return [
    'navigation' => [
        'breadcrumb' => 'My Account',
        'title'      => 'My Account',
        'href'       => 'rage.module.account::account.index',
        'sort'       => -9999,
    ],
    'sections'   => [
        'dashboard' => [
            'buttons' => [
                'new_category',
            ],
            'href'    => 'rage.module.account::account.dashboard',
        ],
        'profile',
    ],
];