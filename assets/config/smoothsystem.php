<?php

return [
    'passport' => [
        'register' => true,
        'custom_routes' => false,
        'expires' => [
            'token' => 15, //days
            'refresh_token' => 30, //days
            'personal_access_token' => 6, //months
        ]
    ],

    'providers' => [
        'roles' => [
            'model' => Smoothsystem\Core\Entities\Role::class
        ],
        'role_users' => [
            'model' => \Smoothsystem\Core\Entities\RoleUser::class
        ]
    ]
];