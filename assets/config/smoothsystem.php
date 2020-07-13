<?php

return [
    'stub' => [
        // custom stub path
        //'path' => app_path('Utilities/Stubs')
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
        'role' => Smoothsystem\Manager\Entities\Role::class,
        'role_user' => Smoothsystem\Manager\Entities\RoleUser::class,
        'permission' => Smoothsystem\Manager\Entities\Permission::class,
        'gate_setting' => Smoothsystem\Manager\Entities\GateSetting::class,
        'gate_setting_permission' => Smoothsystem\Manager\Entities\GateSettingPermission::class,
        'setting' => Smoothsystem\Manager\Entities\Setting::class,
        'file_log' => Smoothsystem\Manager\Entities\FileLog::class,
        'file_log_use' => Smoothsystem\Manager\Entities\FileLogUse::class,
        'number_setting' => Smoothsystem\Manager\Entities\NumberSetting::class,
        'number_setting_component' => Smoothsystem\Manager\Entities\NumberSettingComponent::class,
        'login_activity' => Smoothsystem\Manager\Entities\LoginActivity::class,
    ]
];
