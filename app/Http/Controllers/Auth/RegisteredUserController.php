<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\UserInLms;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;

class RegisteredUserController extends Controller
{
    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $lms_register = [];
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'last_name' => (isset($request->last_name) && $request->last_name != '') ? $request->last_name : null,
            'dni' => (isset($request->dni) && $request->dni != '') ? $request->dni : null,
            'avatar' => (isset($request->avatar) && $request->avatar != '') ? $request->avatar : null,

        ]);

        if ($request->lms_id != null && $request->institution_id != null) {
            $lms_register = UserInLms::create([
                'user_id' => $user->id,
                'lms_id' => $request->lms_id,
                'institution_id' => $request->institution_id,
            ]);
        }


        event(new Registered($user));

        Auth::login($user);

        return response()->json([
            'message' => 'User created successfully',
            'user' => $user,
            'lms_register' => $lms_register
        ], 200);
    }
}
