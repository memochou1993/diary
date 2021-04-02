<?php

namespace App\Http\Resources;

use App\Models\Resource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin Resource
 */
class ResourceResource extends JsonResource
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
            'statements' => StatementResource::collection($this->whenLoaded('statements')),
        ];
    }
}
