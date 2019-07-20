<?php

namespace App\Http\Resources\v1;

use Illuminate\Http\Resources\Json\JsonResource;

class Person extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return $this->format($this->resource);
    }

    private function format(\App\Person $person)
    {
        return [
            'id' => encrypt($person->id),
            'name' => $person->name ?? $person->login,
            'avatar_url' => $person->avatar_url,
            'bio' => $person->bio,
        ];
    }
}
