<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Base\Controller;
use BadassNinjas\Helpers\Response;
use App\Models\Transaction;

class OrdersController extends Controller
{
    public function submitOrder($orderId = null)
    {
        $input = ['payment_status', 'status'];

        $validator = Validator::make(request()->only($input), [
            'payment_status' => 'required',
            'status' => 'required',
        ]);

        if ($validator->fails()) {
            return Response::build($validator->errors()->first(), 500);
        }

        $order = Transaction::updateOrCreate(['id' => $orderId], request()->only($input));
        $order->save();

        return Response::build($order);
    }


    public function getOrders()
    {
        return Response::build(Transaction::with(['user.billing_detail'])->paginate(request('per_page', 15)));
    }
}
