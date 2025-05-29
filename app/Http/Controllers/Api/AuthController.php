<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class AuthController extends BaseController
{


     public function login(Request $request)
{
    $user = DB::table('users')->where('email', $request->email)->first();

    if ($user && Hash::check($request->password, $user->password)) {
        // Generate plain text token
        $plainToken = Str::random(60);
        $hashedToken = hash('sha256', $plainToken);

        // Insert into personal_access_tokens
        DB::table('personal_access_tokens')->insert([
            'tokenable_type' => 'App\\Models\\User',
            'tokenable_id' => $user->id,
            'name' => 'sample',
            'token' => $hashedToken,
            'abilities' => json_encode(['*']),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        $success['token'] = $plainToken;
        $success['email'] = $user->email;

        return $this->sendResponse($success, 'User login successfully!');
    }

    return $this->sendError('Unauthorised', ['error' => 'Unauthorised']);
}


}
