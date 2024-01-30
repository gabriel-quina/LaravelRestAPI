<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request as HttpRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::paginate();

        return UserResource::collection($users);
    }

    public function store(HttpRequest $request)
    {
        $data = $request->all();
        $data['password'] = bcrypt($request->password);

        $user = User::create($data);

        return new UserResource($user);
    }
}
