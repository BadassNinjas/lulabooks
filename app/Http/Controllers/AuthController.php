<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Base\Controller;
use BadassNinjas\Utils\BadassResponse;

class AuthController extends Controller
{
    public function doLogin()
    {
        $validator = Validator::make(request()->all(), [
          'username' => 'min:1',
          'password' => 'min:1',
        ]);

        if ($validator->fails()) {
            return BadassResponse::build('Invalid API Usage', 403);
        }

        if (Auth::attempt(request()->only(['email', 'password']))) {
            return BadassResponse::build(Auth::user());
        }

        return BadassResponse::build('The given username and/or password combination did not render any results.', 404);
    }

    public function doLogout()
    {
        if (Auth::check()) {
            Auth::logout();
        }

        return BadassResponse::build([]);
    }

    public function checkLogin()
    {
        if (Auth::check()) {
            return BadassResponse::build(Auth::user());
        }

        return BadassResponse::build('Unauthenticated', 403);
    }
}
