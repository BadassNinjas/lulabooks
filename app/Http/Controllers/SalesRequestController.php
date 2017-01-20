<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Base\Controller;
use BadassNinjas\Helpers\Response;
use App\Models\SalesRequest;

class SalesRequestController extends Controller
{
    public function submitSalesRequest()
    {
        $input = ['firstname', 'lastname', 'grade', 'name', 'isbn', 'email', 'phone'];

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

        $sales_request = new SalesRequest();
        $sales_request->fill(request()->only($input));
        $sales_request->save();

        return Response::build($sales_request);
    }

    public function getSalesRequests()
    {
        return Response::build(SalesRequest::paginate(request('per_page', 15)));
    }
}
