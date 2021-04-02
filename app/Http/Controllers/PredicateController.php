<?php

namespace App\Http\Controllers;

use App\Http\Requests\PredicateIndexRequest;
use App\Http\Resources\PredicateResource;
use App\Models\Predicate;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class PredicateController extends Controller
{
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // TODO
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
     * @param  \Illuminate\Http\Request  $request
     * @param Predicate $predicate
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Predicate $predicate)
    {
        // TODO
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Predicate $predicate
     * @return \Illuminate\Http\Response
     */
    public function destroy(Predicate $predicate)
    {
        // TODO
    }
}
