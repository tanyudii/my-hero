<?php

namespace tanyudii\Hero\Utilities\Traits;

trait DefaultFormRequest
{
    protected $modelNamespace = 'App\\Models\\';

    public function authorize() : bool
    {
        return true;
    }

    public function rules()
    {
        $nameSpace = $this->modelNamespace . preg_replace('/(CreateRequest|UpdateRequest)/','',class_basename($this));
        $model = app($nameSpace);

        if (!empty($this->id)) {
            return $model->setValidationRules($this->all(), $this->id)
                ->setExceptUpdateFields()
                ->getValidationRules();
        }

        return $model->setValidationRules($this->all())->getValidationRules();
    }

    public function messages()
    {
        $nameSpace = $this->modelNamespace . preg_replace('/(CreateRequest|UpdateRequest)/','',class_basename($this));
        $model = app($nameSpace);

        return $model->setValidationMessages($this->all())->getValidationMessages();
    }

    public function attributes()
    {
        $nameSpace = $this->modelNamespace . preg_replace('/(CreateRequest|UpdateRequest)/','',class_basename($this));
        $model = app($nameSpace);

        return $model->setValidationAttributes($this->all())->getValidationAttributes();
    }
}
