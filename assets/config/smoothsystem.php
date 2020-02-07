<?php

return [
    'providers' => [
        'roles' => [
            'model' => Smoothsystem\Core\Entities\Role::class
        ],
        'role_users' => [
            'model' => \Smoothsystem\Core\Entities\RoleUser::class
        ]
    ]
];