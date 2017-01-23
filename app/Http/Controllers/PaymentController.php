<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Base\Controller;
use BadassNinjas\Helpers\Response;
use AddPay\Http\Client\AddPayHttpClient;
use ShopKit\Core\Facades\ShopKit;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;
use App\Models\Transaction;

class PaymentController extends Controller
{
    public function getPaymentMethods()
    {
        $client = new AddPayHttpClient();
        $result = $client->getPaymentMethods();

        if (!$result) {
            return Response::build('Could not retrieve payment methods', 500);
        }

        return (array) $result;
    }

    public function getPreparedPayment($payment_method)
    {
        $user = Auth::user();

        $client = new AddPayHttpClient();
        $result = $client->preparePayment([
            'payer_firstname' => $user->billing_detail->firstname,
            'payer_lastname' => $user->billing_detail->lastname,
            'payer_email' => $user->billing_detail->email,
            'trans_desc' => 'LulaBooks Online Purchase',
            'trans_method' => $payment_method,
            'trans_amount' => ShopKit::getShoppingCart()->getPriceTotal(),
            'trans_currency' => 'ZAR',
            'notify_url' => str_replace('localhost', 'lulabooks.co.za', URL::to('/api/payments/notify/')),
            'return_url' => str_replace('localhost', 'lulabooks.co.za', URL::to('/payment'))
        ]);



        if (!$result) {
            return Response::build('Could not retrieve payment methods', 500);
        }

        if ($result->success) {
            $transaction = new Transaction();
            $transaction->payment_ref = $result->payload->return_token;
            $transaction->user_id = $user->id;
            $transaction->items = json_encode(ShopKit::getShoppingCart()->getItems());
            $transaction->status = 'UNRESOLVED';
            $transaction->payment_method = $payment_method;
            $transaction->payment_status = 'UNPAID';
            $transaction->items_total = ShopKit::getShoppingCart()->getPriceTotal();
            $transaction->save();

            ShopKit::getShoppingCart()->emptyCart();
        }

        return (array) $result;
    }
}
