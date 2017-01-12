<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Base\Controller;
use BadassNinjas\Helpers\Response;

class AuthController extends Controller
{
    public function doLogin()
    {
        $validator = Validator::make(request()->all(), [
          'username' => 'min:1',
          'password' => 'min:1',
        ]);

        if ($validator->fails()) {
            return Response::build('Invalid API Usage', 403);
        }

        if (Auth::attempt(request()->only(['email', 'password']))) {
            return Response::build(Auth::user());
        }

        return Response::build('The given username and/or password combination did not render any results.', 404);
    }

    public function doLogout()
    {
        if (Auth::check()) {
            Auth::logout();
        }

        return Response::build([]);
    }

    public function checkLogin()
    {
        if (Auth::check()) {
            return Response::build(Auth::user());
        }

        return Response::build('Unauthenticated', 403);
    }
}
