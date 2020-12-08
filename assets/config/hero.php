<?php

return [
    'models' => [
        'user' => config('auth.providers.users.model'),
        'role' => tanyudii\Hero\Entities\Role::class,
        'role_user' => tanyudii\Hero\Entities\RoleUser::class,
        'permission' => tanyudii\Hero\Entities\Permission::class,
        'gate_setting' => tanyudii\Hero\Entities\GateSetting::class,
        'gate_setting_permission' => tanyudii\Hero\Entities\GateSettingPermission::class,
        'setting' => tanyudii\Hero\Entities\Setting::class,
        'media' => tanyudii\Hero\Entities\Media::class,
        'media_use' => tanyudii\Hero\Entities\MediaUse::class,
        'number_setting' => tanyudii\Hero\Entities\NumberSetting::class,
        'number_setting_component' => tanyudii\Hero\Entities\NumberSettingComponent::class,
        'login_activity' => tanyudii\Hero\Entities\LoginActivity::class,
    ]
];
