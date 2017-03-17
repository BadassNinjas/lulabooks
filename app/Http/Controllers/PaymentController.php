<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Base\Controller;
use BadassNinjas\Helpers\Response;
use AddPay\Http\Client\AddPayHttpClient;
use ShopKit\Core\ShopKit;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Log;
use App\Models\Transaction;
use AddPay\Wrapper\Client\Facades\AddPay;
use App\Mail\orderPlaced;


class PaymentController extends Controller
{
    const PAYMENT_PAID = 0;
    const PAYMENT_PENDING = 1;
    const PAYMENT_CANCELLED = 2;
    const PAYMENT_FAILED = 4;

    public function getPaymentMethods()
    {
        $result = AddPay::setAppKey(config('addpay-client.API_APP_KEY'))->setAppSecret(config('addpay-client.API_APP_SECRET'))->getPaymentMethods();

        if (!$result) {
            return Response::build('Could not retrieve payment methods', 500);
        }

        return (array) $result;
    }

    public function postPaymentNotification()
    {
        Log::info('Pamyent notification received: ', ['data' => request()->all()]);

        $payment_ref = request('return_token');

        $transaction = Transaction::where('payment_ref', $payment_ref)->first();
        $transaction_status = request('trans_result');

        switch ($transaction_status) {
          case self::PAYMENT_PAID:
            $transaction->payment_status = 'PAID';
            break;

          case self::PAYMENT_CANCELLED:
              $transaction->payment_status = 'CANCELLED';
              break;

          case self::PAYMENT_FAILED:
              $transaction->payment_status = 'PAYMENT_FAILED';
              break;
        }

        $transaction->save();
    }

    public function getPreparedPayment($payment_method,$shipping)
    {
        $user = Auth::user();

        $result = AddPay::setAppKey(config('addpay-client.API_APP_KEY'))->setAppSecret(config('addpay-client.API_APP_SECRET'))->preparePayment([
            'payer_firstname' => $user->billing_detail->firstname,
            'payer_lastname' => $user->billing_detail->lastname,
            'payer_email' => $user->billing_detail->email,
            'trans_desc' => 'LulaBooks Online Purchase',
            'trans_method' => $payment_method,
            'trans_amount' => ShopKit::getShoppingCart()->getPriceTotal(),
            'trans_currency' => 'ZAR',
            'notify_url' => str_replace('localhost', 'lulabooks.co.za', URL::to('/api/payment/notify/')),
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

            if($shipping === 'true' ){
              $transaction->shipping = 'yes';
            }

            $transaction->items_total = ShopKit::getShoppingCart()->getPriceTotal();
            $transaction->save();

            ShopKit::getShoppingCart()->emptyCart();
        }

        \Mail::to($user->billing_detail->email)->send(new orderPlaced($user));

        return (array) $result;
    }
}
