<?php

namespace App\Http\Controllers;

use App\Http\Requests\StatementIndexRequest;
use App\Http\Requests\StatementStoreRequest;
use App\Http\Requests\StatementUpdateRequest;
use App\Http\Resources\StatementResource;
use App\Models\Statement;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Symfony\Component\HttpFoundation\Response;

class StatementController extends Controller
{
    /**
     * Instantiate a new controller instance.
     */
    public function __construct() {
        $this->authorizeResource(Statement::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @param StatementIndexRequest $request
     * @return AnonymousResourceCollection
     */
    public function index(StatementIndexRequest $request)
    {
        /** @var User $user */
        $user = $request->user();

        $data = $user->statements()->with([
            'subject',
            'object',
            'predicate'
        ])->get();

        return StatementResource::collection($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StatementStoreRequest $request
     * @return StatementResource
     */
    public function store(StatementStoreRequest $request)
    {
        /** @var User $user */
        $user = $request->user();

        $data = $user->statements()->create($request->all());

        return new StatementResource($data);
    }

    /**
     * Display the specified resource.
     *
     * @param Statement $statement
     * @return StatementResource
     */
    public function show(Statement $statement)
    {
        $data = Statement::with([
            'subject',
            'object',
            'predicate'
        ])->find($statement->id);

        return new StatementResource($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StatementUpdateRequest $request
     * @param Statement $statement
     * @return JsonResponse
     */
    public function update(StatementUpdateRequest $request, Statement $statement)
    {
        $statement->update($request->all());

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Statement $statement
     * @return JsonResponse
     */
    public function destroy(Statement $statement)
    {
        Statement::destroy($statement->id);

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
