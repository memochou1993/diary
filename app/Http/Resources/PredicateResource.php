<?php

namespace App\Http\Resources;

use App\Models\Predicate;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin Predicate
 */
class PredicateResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'subjects' => ResourceResource::collection($this->whenLoaded('subjects')),
            'objects' => ResourceResource::collection($this->whenLoaded('objects')),
        ];
    }
}
