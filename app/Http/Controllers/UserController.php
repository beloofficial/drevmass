<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\UpdateUserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function show()
    {
        return auth()->user();
    }

    public function showUserInformation()
    {
        return auth()->user()->with('information', 'day')->find(auth()->id());
    }

    public function update(UpdateUserRequest $request): array|\Illuminate\Contracts\Auth\Authenticatable|null
    {
        $data = $request->validated();

        if (empty($data)) {
            return [
                'status' => 'success',
                'message' => 'empty body',
            ];
        }

        $user = auth()->user();

        if (isset($data['password'])) {
            $user->password = Hash::make($data['password']);
        }

        $user->fill($data);
        $user->save();

        $information = $user->information()->updateOrCreate(['user_id' => $user->id], $data['information']);
        $user->information = $information;

        return $user;
    }
}
