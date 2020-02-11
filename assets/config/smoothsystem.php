<?php

return [
    'authorization' => [
        'register' => false,
    ],
    'passport' => [
        'register' => true,
        'custom_routes' => false,
        'expires' => [
            'token' => 15, //days
            'refresh_token' => 30, //days
            'personal_access_token' => 6, //months
        ]
    ],
    'models' => [
        'user' => config('auth.providers.users.model'),
        'role' => Smoothsystem\Core\Entities\Role::class,
        'role_user' => Smoothsystem\Core\Entities\RoleUser::class,
        'permission' => Smoothsystem\Core\Entities\Permission::class,
        'gate_setting' => Smoothsystem\Core\Entities\GateSetting::class,
        'gate_setting_permission' => Smoothsystem\Core\Entities\GateSettingPermission::class,
    ]
];
