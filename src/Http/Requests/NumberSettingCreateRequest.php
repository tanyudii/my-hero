<?php

namespace Smoothsystem\Manager\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Smoothsystem\Manager\Utilities\Traits\DefaultFormRequest;

class NumberSettingCreateRequest extends FormRequest
{
    use DefaultFormRequest;

    public function __construct(array $query = [], array $request = [], array $attributes = [], array $cookies = [], array $files = [], array $server = [], $content = null)
    {
        $this->entityNamespace = 'Smoothsystem\\Manager\\Entities\\';

        parent::__construct($query, $request, $attributes, $cookies, $files, $server, $content);
    }
}
