<?php

return [
    'models' => [
        'user' => config('auth.providers.users.model'),
        'role' => tanyudii\Hero\Models\Role::class,
        'role_user' => tanyudii\Hero\Models\RoleUser::class,
        'permission' => tanyudii\Hero\Models\Permission::class,
        'gate_setting' => tanyudii\Hero\Models\GateSetting::class,
        'gate_setting_permission' => tanyudii\Hero\Models\GateSettingPermission::class,
        'setting' => tanyudii\Hero\Models\Setting::class,
        'media' => tanyudii\Hero\Models\Media::class,
        'media_use' => tanyudii\Hero\Models\MediaUse::class,
        'number_setting' => tanyudii\Hero\Models\NumberSetting::class,
        'number_setting_component' => tanyudii\Hero\Models\NumberSettingComponent::class,
        'login_activity' => tanyudii\Hero\Models\LoginActivity::class,
    ]
];
