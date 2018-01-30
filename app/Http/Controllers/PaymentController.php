<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Base\Controller;
use App\Helpers\Response;
use AddPay\Http\Client\AddPayHttpClient;
use ShopKit\Core\ShopKit;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Log;
use App\Models\Transaction;
use AddPay\Wrapper\Client\Facades\AddPay;
use App\Mail\orderPlaced;
use AddPay\Client\Containers\Transaction\Transaction as AddpayTransaction;
use AddPay\Foundation\Protocol\API\OpenAPI;

class PaymentController extends Controller
{
    const PAYMENT_PAID = 'processed';
    const PAYMENT_CANCELLED = 'cancelled';
    const PAYMENT_FAILED = 'failed';

    public function getPaymentMethods()
    {
        $api = new OpenAPI();

        $http = $api->services()
                    ->withType('transaction')
                    ->withIntent('SALE')
                    ->get();
        
        return $http->all();
        
    }

    public function postPaymentNotification()
    {
        Log::info('onPostPayment notification');
        $data = request()->all();

        $transaction = Transaction::where('payment_ref', $data['id'])->first();

        switch ($data['status']['state']) {
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

        $api = new OpenAPI();

        $transaction = new Transaction();

        $shipping_fee = 0;

        
        if($shipping === 'true' ){
          $transaction->shipping = 'yes';
          $shipping_fee = 70;
        }

        $http = $api->transactions()
                    ->instantiate()
                    ->withReference('LULPURCHASE'.rand(1,9).rand(0,9).rand(1,9))
                    ->withDescription('Online store book purchase')
                    ->withCustomerFirstname($user->billing_detail->firstname)
                    ->withCustomerLastname($user->billing_detail->lastname)
                    ->withCustomerEmail($user->billing_detail->email)
                    ->withServiceIntent('SALE')
                    ->withServiceKey($payment_method)
                    ->withAmountValue(ShopKit::getShoppingCart()->getPriceTotal()+$shipping_fee)
                    ->withAmountCurrencyCode('ZAR')
                    ->withNotifyUrl('https://lulabooks.dev/api/payment/notify')
                    ->create();

        if ($http->succeeds()) {
            
        } else {
            $errorCode = $http->getErrorCode();
            $errorMsg  = $http->getErrorMessage();

            Log::info("Dang it! Error '{$errorCode}' with message '{$errorMsg}'.");
        }
       
        
        $transaction->payment_ref = $http->getReference();
        $transaction->user_id = $user->id;
        $transaction->items = json_encode(ShopKit::getShoppingCart()->getItems());
        $transaction->status = 'UNRESOLVED';
        $transaction->payment_method = $payment_method;
        $transaction->payment_status = 'UNPAID';

        $transaction->items_total = ShopKit::getShoppingCart()->getPriceTotal()+$shipping_fee;

        $transaction->save();

        ShopKit::getShoppingCart()->emptyCart();

        return $http->all();
    }
}
