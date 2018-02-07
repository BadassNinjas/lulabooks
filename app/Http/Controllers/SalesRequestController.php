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
use DB;


class SalesRequestController extends Controller
{
    public function submitSalesRequest($requestId = null)
    {
        $input = ['firstname', 'lastname', 'grade', 'name', 'isbn', 'email', 'phone',];

        if (Auth::check() && (Auth::user()->role == User::ROLE_ADMIN || Auth::user()->role == User::ROLE_SUPERADMIN)) {
            $input = array_merge($input, ['price', 'status']);
        }

        $validator = Validator::make(request()->only($input), [
          'firstname' => 'required|max:32',
          'lastname' => 'required|max:32',
          'email' => 'required|email',
          'phone' => 'required|max:10|min:10',
          'name' => 'required|max:64',
          'isbn' => 'required|max:13|min:10',
          'grade' => 'required',
      ]);
        if ($validator->fails()) {
            return Response::build($validator->errors()->all(), 500);
        }

        $sales_request = SalesRequest::updateOrCreate(['id' => $requestId], request()->only($input));

        if(is_null(request('price')) || is_null(request('status'))){
          $sales_request->price = 0;
          $sales_request->status = 'UNRESOLVED';
        }

        $sales_request->save();


        $fullname = $sales_request->firstname." ".$sales_request->lastname;

        \Mail::to($sales_request->email)->send(new saleRequestUserMail($fullname));

        //\Mail::to(request()->adminEmail)->send(new saleRequestUserMail($fullname));

        
        //\Mail::to(request()->adminEmail)->send(new saleRequestAdminMail($sales_request));
        
        

        return Response::build("success success");
    }

    public function deleteAllSalesRequests(){

        $request = SalesRequest::truncate();

        return Response::build('all entries in the sale request database have been delete');
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
