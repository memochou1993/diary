<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserShowRequest;
use App\Http\Resources\UserResource;
use App\Models\User;

class UserController extends Controller
{

    /**
     * Display the specified resource.
     *
     * @param UserShowRequest $request
     * @return UserResource
     */
    public function show(UserShowRequest $request)
    {
        /** @var User $data */
        $data = User::with([
            'resource',
        ])->find($request->user()->id);

        return new UserResource($data);
    }
}
