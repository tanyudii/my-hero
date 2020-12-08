<?php

namespace tanyudii\Hero\Entities;

use Illuminate\Support\Facades\Storage;
use tanyudii\Hero\Http\Resources\MediaResource;
use tanyudii\Hero\Rules\ValidInConstant;
use tanyudii\Hero\Utilities\Entities\BaseEntity;

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
        return $this->hasMany(config('hero.models.media_use'));
    }

    /**
     * @return string
     */
    public function getUrlAttribute() : string
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
