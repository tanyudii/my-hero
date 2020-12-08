<?php

namespace tanyudii\Hero\Rules;

use Illuminate\Contracts\Validation\Rule;

class MustBeTrue implements Rule
{
    protected $message;

    /**
     * Create a new rule instance.
     *
     * @param string $message
     */
    public function __construct(string $message = 'The :attribute must be true.')
    {
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
        return $value;
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
