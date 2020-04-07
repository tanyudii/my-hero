<?php

namespace Smoothsystem\Manager\Entities;

use Illuminate\Support\Carbon;
use Smoothsystem\Manager\Utilities\Entities\BaseEntity;

class RoleUser extends BaseEntity
{
    protected $fillable = [
        'role_id',
        'user_id',
        'valid_from',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($data) {
            if (!$data->valid_from) {
                $data->valid_from = Carbon::now();
            }
        });
    }

    public function user() {
        return $this->belongsTo(config('smoothsystem.models.user'));
    }

    public function role() {
        return $this->belongsTo(config('smoothsystem.models.role'));
    }

}
