<?php

namespace tanyudii\Hero\Utilities\Traits;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Carbon;
use tanyudii\Hero\Utilities\Entities\HasManySyncAble;

trait WithUserGateHero
{
    /**
     * @return BelongsToMany
     */
    public function roles() : BelongsToMany
    {
        return $this->belongsToMany(config('hero.models.role'), 'role_users')->withTimestamps();
    }

    /**
     * @return HasManySyncAble
     */
    public function roleUsers() : HasManySyncAble
    {
        return $this->hasMany(config('hero.models.role_user'));
    }

    /**
     * @return HasOne
     */
    public function roleUser() : HasOne
    {
        return $this->hasOne(config('hero.models.role_user'))
            ->whereDate('role_users.valid_from', '<=', Carbon::now()->toDateString())
            ->orderByDesc('role_users.valid_from');
    }

    /**
     * @param null $date
     * @return mixed
     */
    public function permissions($date = null)
    {
        if (is_null($date)) {
            $date = Carbon::now()->toDateString();
        }

        $gateSettingIds = config('hero.models.gate_setting')::select('gate_settings.id')
            ->where('gate_settings.user_id', $this->id)
            ->where('gate_settings.valid_from', '<=', $date)
            ->orderByDesc('gate_settings.valid_from')
            ->limit(1)
            ->pluck('id')
            ->toArray();

        if (empty($gateSettingIds)) {
            $role = $this->roleUser()->exists() ? $this->roleUser->role : null;

            $roleChildrenIds = [];
            if (!empty($role)) {
                if ($role->is_special) {
                    return config('hero.models.permission')::query();
                }

                $roleChildrenIds = $role->children_ids;
            }

            $gateSettingIds = config('hero.models.gate_setting')::select('gate_settings.id')
                ->whereIn('gate_settings.role_id', $roleChildrenIds)
                ->where('gate_settings.valid_from', '<=', $date)
                ->orderByDesc('gate_settings.valid_from')
                ->pluck('id')
                ->toArray();
        }

        $permissionIds = config('hero.models.gate_setting_permission')::select('gate_setting_permissions.permission_id')
            ->whereHas('gateSetting', function ($query) use ($gateSettingIds) {
                $query->whereIn('gate_settings.id', $gateSettingIds);
            })->distinct()->pluck('gate_setting_permissions.permission_id')->toArray();

        return config('hero.models.permission')::whereIn('id', $permissionIds);
    }

    /**
     * @param $action
     * @return bool
     */
    public function authorized($action) : bool
    {
        return $this->permissions()->where('permissions.name', $action)->exists();
    }
}