<?php

return [
    'navigation' => [
        'breadcrumb' => 'Account',
        'title'      => 'Dashboard',
        'href'       => 'rage.module.account::account.dashboard',
        'sort'      => -9999,
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