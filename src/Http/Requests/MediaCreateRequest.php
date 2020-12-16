<?php

namespace tanyudii\Hero\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use tanyudii\Hero\Utilities\Traits\DefaultFormRequest;

class MediaCreateRequest extends FormRequest
{
    use DefaultFormRequest;

    public function __construct(array $query = [], array $request = [], array $attributes = [], array $cookies = [], array $files = [], array $server = [], $content = null)
    {
        $this->modelNamespace = 'tanyudii\\Hero\\Models\\';

        parent::__construct($query, $request, $attributes, $cookies, $files, $server, $content);
    }
}
