<?php

namespace tanyudii\Hero\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Arr;
use tanyudii\Hero\Utilities\Entities\BaseEntity;

class ValidUnique implements Rule
{
    protected $id;
    protected $model;
    protected $message;

    /**
     * Create a new rule instance.
     *
     * @param $model
     * @param null $id
     * @param string $message
     */
    public function __construct($model, $id = null, string $message = 'The :attribute has already been taken.')
    {
        if (is_string($model) && class_exists($model)) {
            $model = app($model);
        }

        if ($model instanceof BaseEntity) {
            $this->model = $model;
        }

        $this->id = $id;
        $this->message = $message;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value) : bool
    {
        if (empty($this->model)) {
            return false;
        }

        $attribute = Arr::last(explode('.',$attribute));

        $query = $this->model->where($attribute, $value);
        if ($this->id) {
            $query = $query->where('id', '!=', $this->id);
        }

        return !$query->exists();

    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message() : string
    {
        return __($this->message);
    }
}
