<?php

namespace tanyudii\Hero\Utilities\Traits;

use Illuminate\Database\Eloquent\Builder;
use tanyudii\Hero\Rules\NotPresent;

trait WithModelValidation
{
    /**
     * Default Rules for Request form
     *
     * @var array
     */
    protected $validationRules = [];

    /**
     * Default Messages for Request Form
     *
     * @var array
     */
    protected $validationMessages = [];

    /**
     * Default Properties for Request Form
     *
     * @var array
     */
    protected $validationAttributes = [];

    /**
     * Set not present field when update
     *
     * @var array
     */
    protected $exceptUpdateFields = [];

    /**
     * @return array
     */
    public function getDefaultRules() : array
    {
        $validationRules = [];

        foreach ($this->getFillable() as $field) {
            $validationRules[$field] = [new NotPresent()];
        }

        return $validationRules;
    }

    /**
     * @return $this
     */
    public function assignNotPresent()
    {
        foreach ($this->getFillable() as $field) {
            if (!array_key_exists($field,$this->validationRules)) {
                $this->validationRules[$field] = [new NotPresent()];
            }
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function setExceptUpdateFields()
    {
        foreach ($this->exceptUpdateFields as $exceptUpdateField) {
            $this->validationRules[$exceptUpdateField] = [ new NotPresent() ];
        }

        return $this;
    }

    /**
     * @param array $request
     * @param null $id
     * @return $this
     */
    public function setValidationRules(array $request = [], $id = null)
    {
        return $this;
    }

    /**
     * @param array $request
     * @return $this
     */
    public function setValidationMessages(array $request = [])
    {
        return $this;
    }

    /**
     * @param array $request
     * @return $this
     */
    public function setValidationAttributes(array $request = [])
    {
        return $this;
    }

    /**
     * @return array
     */
    public function getValidationRules() : array
    {
        $this->assignNotPresent();

        return $this->validationRules;
    }

    /**
     * @return array
     */
    public function getValidationMessages() : array
    {
        return $this->validationMessages;
    }

    /**
     * @return array
     */
    public function getValidationAttributes() : array
    {
        return $this->validationAttributes;
    }

}
