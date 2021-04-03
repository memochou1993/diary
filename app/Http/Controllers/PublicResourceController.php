<?php

namespace App\Http\Controllers;

use App\Http\Requests\PublicResourceShowRequest;
use App\Http\Requests\ResourceIndexRequest;
use App\Http\Resources\ResourceResource;
use App\Models\Resource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class PublicResourceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param ResourceIndexRequest $request
     * @return AnonymousResourceCollection
     */
    public function index(ResourceIndexRequest $request)
    {
        $data = Resource::with([
            'subjectStatements.predicate',
            'subjectStatements.subject',
            'objectStatements.object',
            'objectStatements.predicate',
        ])->whereHas('objectStatements.predicate', function ($query) {
            return $query->where('name', 'is');
        })->whereHas('objectStatements.object', function ($query) {
            return $query->where('name', 'public');
        })->get();

        return ResourceResource::collection($data);
    }

    /**
     * Display the specified resource.
     *
     * @param PublicResourceShowRequest $request
     * @param Resource $resource
     * @return ResourceResource
     */
    public function show(PublicResourceShowRequest $request, Resource $resource)
    {
        $data = Resource::with([
            'subjectStatements.predicate',
            'subjectStatements.subject',
            'objectStatements.object',
            'objectStatements.predicate',
        ])->find($resource->id);

        return new ResourceResource($data);
    }
}
