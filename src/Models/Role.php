<?php

namespace tanyudii\Hero\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use tanyudii\Hero\Rules\ValidUnique;
use tanyudii\Hero\Utilities\Models\BaseModel;

class Role extends BaseModel
{
    protected $fillable = [
        'code',
        'name',
        'description',
        'parent_id',
        'is_special',
    ];

    protected $casts = [
        'is_special' => 'boolean',
    ];

    protected $validationRules = [
        'name' => 'required|string|max:255',
        'description' => 'nullable|string|max:255',
        'parent_id' => 'nullable|exists:roles,id,deleted_at,NULL',
        'is_special' => 'boolean',
    ];

    /**
     * @return BelongsTo
     */
    public function parent() : BelongsTo
    {
        return $this->belongsTo(config('hero.models.role'))->with('parent');
    }

    /**
     * @return HasMany
     */
    public function children() : HasMany
    {
        return $this->hasMany(config('hero.models.role'),'parent_id')->with('children');
    }

    /**
     * @return HasMany
     */
    public function roleUsers() : HasMany
    {
        return $this->hasMany(config('hero.models.role_user'));
    }

    /**
     * @return array
     */
    public function getChildrenIdsAttribute() : array
    {
        $data = [];

        $this->recursiveChildrenGetAttribute($this, $data);

        return $data;
    }

    /**
     * @param $child
     * @param $data
     * @param string $key
     */
    public function recursiveChildrenGetAttribute($child, &$data, $key = 'id') : void
    {
        array_push($data, $child[$key]);

        if (count($child->children) > 0) {
            foreach ($child->children as $child) {
                $this->recursiveChildrenGetAttribute($child, $data, $key);
            }
        }
    }

    public function setValidationRules(array $request = [], $id = null)
    {
        $this->validationRules['code'] = [
            'required',
            'string',
            'max:24',
            new ValidUnique($this,$id),
        ];

        return $this;
    }

}
