<?php

namespace App\Http\Controllers;

use App\Http\Requests\ResourceIndexRequest;
use App\Http\Requests\ResourceShowRequest;
use App\Http\Resources\ResourceResource;
use App\Models\Resource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ResourceController extends Controller
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
            'user',
            'subjectStatements.predicate',
            'subjectStatements.subject',
            'objectStatements.object',
            'objectStatements.predicate',
        ])->whereHas('objectStatements.predicate', function ($query) {
            return $query->where('name', 'meta:is');
        })->whereHas('objectStatements.object', function ($query) {
            return $query->where('name', 'meta:public');
        })->when($request->input('name'), function ($query, $name) {
            $query->where('name', $name);
        })->when($request->input('user_name'), function ($query, $user_name) {
            $query->whereHas('user', function ($query) use ($user_name) {
                return $query->where('name', $user_name);
            });
        })->get();

        return ResourceResource::collection($data);
    }

    /**
     * Display the specified resource.
     *
     * @param ResourceShowRequest $request
     * @param Resource $resource
     * @return ResourceResource
     */
    public function show(ResourceShowRequest $request, Resource $resource)
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
