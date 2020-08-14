<?php

namespace Smoothsystem\Manager\Entities;

use Illuminate\Support\Facades\Storage;
use Smoothsystem\Manager\Http\Resources\MediaResource;
use Smoothsystem\Manager\Rules\ValidInConstant;
use Smoothsystem\Manager\Utilities\Entities\BaseEntity;

class Media extends BaseEntity
{
    protected $indexResource = MediaResource::class;
    protected $showResource = MediaResource::class;
    protected $selectResource = MediaResource::class;

    protected $fillable = [
        'name',
        'encoded_name',
        'size',
        'extension',
        'path',
        'disk',
    ];

    protected $validationRules = [
        'path' => 'required|string',
    ];

    public function mediaUses()
    {
        return $this->hasMany(config('smoothsystem.models.media_use'));
    }

    public function getUrlAttribute()
    {
        return Storage::disk($this->disk)->url($this->path);
    }

    public function setValidationRules(array $request = [], $id = null)
    {
        $this->validationRules['disk'] = [
            'required',
            new ValidInConstant(array_keys(config('filesystems.disks', []))),
        ];

        $fileRules = ['required'];

        $mimes = @$request['mimes'] ?? [];
        if (!empty($mimes)) {
            $fileRules[] = 'mimes:' . (is_array($mimes) ? implode($mimes,',') : $mimes);
        }

        if ($maxSize = @$request['max_size']) {
            $fileRules[] = 'max:' . $maxSize;
        }

        $this->validationRules['file'] = $fileRules;

        return $this;
    }

}
