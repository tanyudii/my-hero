<?php

namespace tanyudii\Hero\Http\Resources;

class CreatorResource extends BaseResource
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
