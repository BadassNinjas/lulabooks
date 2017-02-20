<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Base\Controller;
use BadassNinjas\Helpers\Response;
use App\Models\SalesRequest;

use ShopKit\ACL\Models\User;

class SalesRequestController extends Controller
{
    public function submitSalesRequest($requestId = null)
    {
        $input = ['firstname', 'lastname', 'grade', 'name', 'isbn', 'email', 'phone'];

        if (Auth::check() && (Auth::user()->role == User::ROLE_ADMIN || Auth::user()->role == User::ROLE_SUPERADMIN)) {
            $input = array_merge($input, ['price', 'status']);
        }

        $validator = Validator::make(request()->only($input), [
          'firstname' => 'required',
          'lastname' => 'required',
          'email' => 'required|email',
          'phone' => 'required',
          'name' => 'required',
          'isbn' => 'required',
          'grade' => 'required',
      ]);

        if ($validator->fails()) {
            return Response::build($validator->errors()->first(), 500);
        }

        $sales_request = SalesRequest::updateOrCreate(['id' => $requestId], request()->only($input));
        $sales_request->save();

        return Response::build($sales_request);
    }


    public function getSalesRequests()
    {
        return Response::build(SalesRequest::paginate(request('per_page', 15)));
    }
}
