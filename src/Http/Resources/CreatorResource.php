<?php

namespace Smoothsystem\Manager\Http\Resources;

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
