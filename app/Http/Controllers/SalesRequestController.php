<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Base\Controller;
use App\Helpers\Response;
use App\Models\SalesRequest;
use App\Mail\saleRequestUserMail;
use App\Mail\saleRequestAdminMail;
use App\Models\User;
use Log;


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


        $fullname = $sales_request->firstname." ".$sales_request->lastname;

        \Mail::to($sales_request->email)->send(new saleRequestUserMail($fullname));

        
       
        \Mail::to('wananaluckyl@gmail.com','lucky')->send(new saleRequestAdminMail($sales_request));
        

        return Response::build("success success");
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
