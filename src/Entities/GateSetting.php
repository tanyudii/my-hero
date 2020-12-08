<?php

namespace tanyudii\Hero\Entities;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;
use tanyudii\Hero\Utilities\Entities\BaseEntity;

class GateSetting extends BaseEntity
{
    protected $fillable = [
        'role_id',
        'user_id',
        'valid_from',
    ];

    protected $dates = [
        'valid_from',
    ];

    protected $validationRules = [
        'role_id' => 'required_without:user_id|exists:roles,id,deleted_at,NULL',
        'user_id' => 'required_without:role_id|exists:users,id,deleted_at,NULL',
        'valid_from' => 'required|date_format:Y-m-d',
        'permission_ids' => 'required|array|min:1',
        'permission_ids.*' => 'required|exists:permissions,id,deleted_at,NULL',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($data) {
            if (is_null($data->valid_from)) {
                $data->valid_from = Carbon::now()->toDateString();
            }
        });
    }

    /**
     * @return BelongsTo
     */
    public function role() : BelongsTo
    {
        return $this->belongsTo(config('hero.entities.role'));
    }

    /**
     * @return BelongsTo
     */
    public function user() : BelongsTo
    {
        return $this->belongsTo(config('hero.entities.user'));
    }

    /**
     * @return HasMany
     */
    public function gateSettingPermissions() : HasMany
    {
        return $this->hasMany(config('hero.models.gate_permission_setting'));
    }

    /**
     * @return BelongsToMany
     */
    public function permissions() : BelongsToMany
    {
        return $this->belongsToMany(config('hero.models.permission'), 'gate_setting_permissions')->withTimestamps();
    }

}
