<?php

namespace tanyudii\Hero\Http\Resources;

class EditorResource extends BaseResource
{
    /**
     * Transform the resource into an array.
     *
     * @param $request
     * @return array
     */
    public function resource($request)
    {
        return [
            'name' => $this->name,
        ];
    }

}
