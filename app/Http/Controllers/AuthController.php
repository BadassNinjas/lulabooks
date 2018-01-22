<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Base\Controller;
use App\Helpers\Response;
use App\Models\User;

class AuthController extends Controller
{
    public function doLogin()
    {
        $validator = Validator::make(request()->all(), [
          'email' => 'required|min:1',
          'password' => 'required|min:1',
        ]);

        if ($validator->fails()) {
            return Response::build('Invalid API Usage', 403);
        }

        if (Auth::attempt(request()->only(['email', 'password']))) {
            $user = Auth::user();
            $user->billing_detail;
            $user->shipping_detail;

            return Response::build($user);
        }

        return Response::build('The given username and/or password combination did not render any results.', 404);
    }

    public function doRegister()
    {
        $validator = Validator::make(request()->all(), [
          'email' => 'required|unique:user|min:1',
          'password' => 'required|min:4|confirmed',
          'password_confirmation' => 'required',
        ]);

        if ($validator->fails()) {
            return Response::build($validator->errors()->first(), 403);
        }

        $user = new User();
        $user->firstname = '';
        $user->lastname = '';
        $user->email = request('email');
        $user->password = bcrypt(request('password'));
        $user->save();

        $user->billing_detail;
        $user->shipping_detail;

        Auth::login($user);

        return Response::build($user);
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
            $user = Auth::user();
            $user->billing_detail;
            $user->shipping_detail;

            return Response::build($user);
        }

        return Response::build('Unauthenticated', 403);
    }
}
