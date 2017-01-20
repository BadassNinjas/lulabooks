<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Base\Controller;
use BadassNinjas\Helpers\Response;
use AddPay\Http\Client\AddPayHttpClient;
use ShopKit\Core\Facades\ShopKit;

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
          'notify_url' => 'https://lulabooks.mobi/',
          'return_url' => 'https://lulabooks.mobi/',
      ]);

        if (!$result) {
            return Response::build('Could not retrieve payment methods', 500);
        }

        return (array) $result;
    }
}
