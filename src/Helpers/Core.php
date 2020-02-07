<?php

function userClass() {
    return config('auth.providers.users.model', \Smoothsystem\Core\Entities\User::class);
}

function roleClass() {
    return config('smoothsystem.providers.roles.model', \Smoothsystem\Core\Entities\Role::class);
}

function roleUserClass() {
    return config('smoothsystem.providers.role_users.model', \Smoothsystem\Core\Entities\RoleUser::class);
}