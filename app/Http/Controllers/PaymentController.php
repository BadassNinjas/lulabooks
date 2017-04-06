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
use AddPay\Client\Containers\Transaction\Transaction as AddpayTransaction;

class PaymentController extends Controller
{
    const PAYMENT_PAID = 0;
    const PAYMENT_PENDING = 1;
    const PAYMENT_CANCELLED = 2;
    const PAYMENT_FAILED = 4;

    public function getPaymentMethods()
    {
        $result = AddPay::setAppId(config('addpay-client.API_APP_KEY'))->setAppSecret(config('addpay-client.API_APP_SECRET'))->getPaymentMethods();

        if (!$result) {
            return Response::build('Could not retrieve payment methods', 500);
        }
        $result = json_decode($result->getBody());
        return (array) $result;
    }

    public function postPaymentNotification()
    {
        Log::info('Pamyent notification received: ', ['data' => request()->all()]);

        $payment_ref = request('return_token');
        Log::info($payment_ref);
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
        $payment_reference = '';
        $transaction = new AddpayTransaction();
        $transaction->setPayerFirstname($user->billing_detail->firstname);
        $transaction->setPayerLastname($user->billing_detail->lastname);
        $transaction->setPayerEmail($user->billing_detail->email);
        $transaction->setMethod($payment_method); // see getPaymentMethods()
        $transaction->setAmountValue(ShopKit::getShoppingCart()->getPriceTotal()*100);
        $transaction->setAmountCurrency('ZAR');
        $transaction->setAppReturnUrl(str_replace('localhost', 'lulabooks.co.za', URL::to('/payment')));
        $transaction->setAppNotifyUrl(str_replace('localhost', 'lulabooks.co.za', URL::to('/api/payment/notify/')));
        $transaction->setApiMode('live');

        try {
            $result = AddPay::setAppId(config('addpay-client.API_APP_KEY'))
                            ->setAppSecret(config('addpay-client.API_APP_SECRET'))
                            ->submitTransaction($transaction);
            $result = json_decode($result->getBody());
            foreach($result as $key => $value){

              if($key ==='reference'){
                $payment_reference = $value;
              }
            }
        }
        catch (RequestException $e) {
            return Response::build($e->getMessage(), 500);
        } catch (ConnectException $e) {
            return Response::build($e->getMessage(), 500);
        } catch (ClientException $e) {
            return Response::build($e->getMessage(), 500);
        } catch (\Exception $e) {
            return Response::build($e->getMessage(), 500);
        }

        $transaction = new Transaction();
        $transaction->payment_ref = $payment_reference;
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

        return (array) $result;
    }
}
