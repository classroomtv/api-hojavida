<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateProfileRequest;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    public function info()
    {
        $user = User::find(auth()->user()->id);
        return UserResource::make($user);
    }

    public function update(UpdateProfileRequest $request)
    {

        $user = User::find(auth()->user()->id);
        $user->name = $request->input('name', $user->name);
        $user->email = $request->input('email', $user->email);
        $user->last_name = $request->input('last_name', $user->last_name);
        $user->birthdate = $request->input('birthdate', $user->birthdate);
        $user->phone = $request->input('phone', $user->phone);
        $user->address = $request->input('address', $user->address);
        $user->dni = $request->input('dni', $user->dni);
        $user->about_me = $request->input('about_me', $user->about_me);
        $user->avatar = $request->input('avatar', $user->avatar);
        $user->occupation = $request->input('occupation', $user->occupation);
        $user->save();
        return UserResource::make($user);
    }

    public function setSocialNetwork(Request $request)
    {
    }
}
