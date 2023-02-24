<?php

namespace App\Http\Controllers\Api;

use App\Helpers\Api;
use App\Helpers\ApiValidate;
use App\Helpers\Validate;
use App\Http\Controllers\Controller;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = Validate::login($request, User::class);

        if (Auth::guard('user')->attempt($credentials)) {
            $user = User::find(Auth::guard('user')->user()->id);
                  return Api::setResponse('user', $user->withToken());
        } 
        else if(Auth::guard('teacher')->attempt($credentials)){
            $teacher = Teacher::find(Auth::guard('teacher')->user()->id);
            return Api::setResponse('user', $teacher->withToken());

        }
        else {
            return Api::setError('Invalid credentials');
        }
    }
}
