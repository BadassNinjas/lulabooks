<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Base\Controller;
use BadassNinjas\Helpers\Response;
use App\Models\ContactMessage;

class ContactController extends Controller
{
    public function submitContactMessage()
    {
        $input = ['firstname', 'lastname', 'email', 'phone', 'message'];

        $validator = Validator::make(request()->only($input), [
          'firstname' => 'required',
          'lastname' => 'required',
          'email' => 'required|email',
          'phone' => 'required',
          'message' => 'required',
      ]);

        if ($validator->fails()) {
            return Response::build($validator->errors()->first(), 500);
        }

        $message = new ContactMessage();
        $message->fill(request()->only($input));
        $message->save();

        return Response::build($message);
    }
}
