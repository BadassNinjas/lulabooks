<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Base\Controller;
use BadassNinjas\Helpers\Response;
use App\Models\SalesRequest;
use App\Mail\saleRequestMail;
use Illuminate\Support\Facades\Mail;


use App\Models\User;

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

        if(is_null(request('price')) || is_null(request('status'))){
          $sales_request->price = 0;
          $sales_request->status = 'UNRESOLVED';
        }

        $sales_request->save();

        Mail::to($sales_request->email)->send(new SaleRequestMail($sales_request->firstname));
        
        return Response::build($sales_request);
    }


    public function getSalesRequests()
    {
        return Response::build(SalesRequest::paginate(request('per_page', 15)));
    }
    public function deleteSalesRequest($saleId){

      $salesrequest = SalesRequest::find($saleId);

      if(!is_null($salesrequest)){
        $salesrequest->delete();
      }

      return Response::build();

    }
}
