<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\PredicateIndexRequest;
use App\Http\Requests\PredicateStoreRequest;
use App\Http\Resources\PredicateResource;
use App\Models\Predicate;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Symfony\Component\HttpFoundation\Response;

class PredicateController extends Controller
{
    /**
     * Instantiate a new controller instance.
     */
    public function __construct() {
        $this->authorizeResource(Predicate::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @param PredicateIndexRequest $request
     * @return AnonymousResourceCollection
     */
    public function index(PredicateIndexRequest $request)
    {
        /** @var User $user */
        $user = $request->user();

        $data = $user->predicates()->get();

        return PredicateResource::collection($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param PredicateStoreRequest $request
     * @return PredicateResource
     */
    public function store(PredicateStoreRequest $request)
    {
        /** @var User $user */
        $user = $request->user();

        $data = $user->predicates()->create($request->all());

        return new PredicateResource($data);
    }

    /**
     * Display the specified resource.
     *
     * @param Predicate $predicate
     * @return PredicateResource
     */
    public function show(Predicate $predicate)
    {
        $data = Predicate::with([
            'subjects',
            'objects',
        ])->find($predicate->id);

        return new PredicateResource($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param PredicateStoreRequest $request
     * @param Predicate $predicate
     * @return JsonResponse
     */
    public function update(PredicateStoreRequest $request, Predicate $predicate)
    {
        $predicate->update($request->all());

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Predicate $predicate
     * @return JsonResponse
     */
    public function destroy(Predicate $predicate)
    {
        Predicate::destroy($predicate->id);

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
