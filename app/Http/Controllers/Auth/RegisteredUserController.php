<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\UserInLms;
use App\Utilities\helpers;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use TypeError;

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
        if ($request->has('hash')) {
            $hash = $request->input('hash');
        } else {
            $hash = "";
        }

        $lms_data = $this->getHash($hash);
        $lms_data = json_decode(json_encode($lms_data), true);

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
            'dni' => $lms_data['rut'],
            'avatar' => $lms_data['avatar_url'],

        ]);

        if ($lms_data['user_id'] != null && $lms_data['institution_id'] != null) {
            $lms_register = UserInLms::create([
                'user_id' => $user->id,
                'lms_id' => intval($lms_data['user_id']),
                'institution_id' => intval($lms_data['institution_id']),
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

    public function getHash($hash) {

        $clave = date('Ymd');

        if (!empty($hash)) {
            try {
                $data = Helpers::descifrar($hash, $clave);
            } catch (TypeError $e) {
                return response()->json([
                    'message' => 'Error al descifrar los datos',
                    'error' => $e->getMessage()
                ], 500);
            }

        } else {
            $data = [];
        }

        return json_decode($data);
    }
}
