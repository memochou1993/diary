<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\ResourceIndexRequest;
use App\Http\Requests\ResourceStoreRequest;
use App\Http\Requests\ResourceUpdateRequest;
use App\Http\Resources\ResourceResource;
use App\Models\Resource;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Symfony\Component\HttpFoundation\Response;

class ResourceController extends Controller
{
    /**
     * Instantiate a new controller instance.
     */
    public function __construct() {
        $this->authorizeResource(Resource::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @param ResourceIndexRequest $request
     * @return AnonymousResourceCollection
     */
    public function index(ResourceIndexRequest $request)
    {
        /** @var User $user */
        $user = $request->user();

        $data = $user->resources()->get();

        return ResourceResource::collection($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ResourceStoreRequest $request
     * @return ResourceResource
     */
    public function store(ResourceStoreRequest $request)
    {
        /** @var User $user */
        $user = $request->user();

        $data = $user->resources()->create($request->all());

        return new ResourceResource($data);
    }

    /**
     * Display the specified resource.
     *
     * @param Resource $resource
     * @return ResourceResource
     */
    public function show(Resource $resource)
    {
        $data = Resource::with([
            'subjectStatements.predicate',
            'subjectStatements.subject',
            'objectStatements.object',
            'objectStatements.predicate',
        ])->find($resource->id);

        return new ResourceResource($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ResourceUpdateRequest $request
     * @param Resource $resource
     * @return JsonResponse
     */
    public function update(ResourceUpdateRequest $request, Resource $resource)
    {
        $resource->update($request->all());

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Resource $resource
     * @return JsonResponse
     */
    public function destroy(Resource $resource)
    {
        Resource::destroy($resource->id);

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
