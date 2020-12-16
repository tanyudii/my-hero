<?php

namespace tanyudii\Hero\Models;

use tanyudii\Hero\Rules\ValidModel;
use tanyudii\Hero\Rules\ValidInConstant;
use tanyudii\Hero\Rules\ValidNumberSettingComponent;
use tanyudii\Hero\Rules\ValidUnique;
use tanyudii\Hero\Utilities\Constant;
use tanyudii\Hero\Utilities\Models\BaseModel;
use tanyudii\Hero\Utilities\HasManySyncAble;

class NumberSetting extends BaseModel
{
    protected $fillable = [
        'name',
        'model',
        'reset_type',
    ];

    protected $validationRules = [
        'name' => 'required|string|max:255',
        'number_setting_components.*.sequence' => 'required|distinct|integer|min:1',
    ];

    /**
     * @return HasManySyncAble
     */
    public function numberSettingComponents() : HasManySyncAble
    {
        return $this->hasMany(config('hero.models.number_setting_component'));
    }

    public function setValidationRules(array $request = [], $id = null)
    {
        $this->validationRules['model'] = [
            'required',
            new ValidUnique($this, $id),
            new ValidModel(),
        ];

        $this->validationRules['reset_type'] = [
            'nullable',
            new ValidInConstant(Constant::NUMBER_SETTING_RESET_TYPE_OPTIONS),
        ];

        $this->validationRules['number_setting_components'] = [
            'required',
            'array',
            'min:1',
            new ValidNumberSettingComponent()
        ];

        $this->validationRules['number_setting_components.*.type'] = [
            'required',
            new ValidInConstant(Constant::NUMBER_SETTING_COMPONENT_TYPE_OPTIONS),
        ];

        $numberSettingComponents = @$request['number_setting_components'] ?? [];
        if (is_array($numberSettingComponents)) {
            foreach ($numberSettingComponents as $index => $numberSettingComponent) {
                $rules = ['required'];
                switch($numberSettingComponent['type']) {
                    case Constant::NUMBER_SETTING_COMPONENT_TYPE_YEAR:
                        $rules[] = 'in:y,Y';
                        break;
                    case Constant::NUMBER_SETTING_COMPONENT_TYPE_MONTH:
                        $rules[] = 'in:m,M,F,n';
                        break;
                    case Constant::NUMBER_SETTING_COMPONENT_TYPE_DAY:
                        $rules[] = 'in:d,D,j,l';
                        break;
                    case Constant::NUMBER_SETTING_COMPONENT_TYPE_COUNTER:
                        $rules[] = 'integer';
                        $rules[] = 'min:1';
                        break;
                }

                $this->validationRules["number_setting_components.{$index}.format"] = $rules;
            }
        }

        return $this;
    }

}
