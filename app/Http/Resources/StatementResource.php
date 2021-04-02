<?php

namespace App\Http\Resources;

use App\Models\Statement;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin Statement
 */
class StatementResource extends JsonResource
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
            'subject' => new ResourceResource($this->whenLoaded('subject')),
            'predicate' => new PredicateResource($this->whenLoaded('predicate')),
            'object' => new ResourceResource($this->whenLoaded('object')),
        ];
    }
}
