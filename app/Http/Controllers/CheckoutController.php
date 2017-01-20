<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Base\Controller;
use BadassNinjas\Helpers\Response;
use ShopKit\ACL\Models\User;
use ShopKit\ACL\Models\UserBillingDetail;
use ShopKit\ACL\Models\UserShippingDetail;
use BadassNinjas\Geo\Models\Country;
use BadassNinjas\Geo\Models\Region;
use BadassNinjas\Geo\Models\City;

class CheckoutController extends Controller
{
    public function updateBillingDetail()
    {
        $validator = Validator::make(request()->all(), [
          'firstname' => 'required',
          'lastname' => 'required',
          'email' => 'required|email',
          'company' => '',
          'company_vat'  => '',
          'phone' => 'required',
          'country_id' => 'exists:' . config('badass-geolocation.tables.country') . ',id',
          'region_id' => 'exists:' . config('badass-geolocation.tables.region') . ',id',
          'city_id' => 'exists:' . config('badass-geolocation.tables.city') . ',id',
          'building' => '',
          'street' => 'required',
          'postcode' => 'required',
        ]);

        $user = Auth::user();

        if (is_null($user) || is_null($user->billing_detail)) {
            if (!request('country_id', false)) {
                return Response::build('Country is required', 403);
            }

            if (!request('region_id', false)) {
                return Response::build('Region/state is required', 403);
            }

            if (!request('city_id', false)) {
                return Response::build('City/Town is required', 403);
            }
        }

        if (!Auth::check()) {
            $user = new User();
            $user->firstname = 'Guest';
            $user->lastname = 'Guest';
            $user->email = 'Guest';
            $user->password = 'Guest';
            $user->save();

            $billing_detail = new UserBillingDetail();
        } else {
            $user = Auth::user();
            $billing_detail = $user->billing_detail;

            if (is_null($billing_detail)) {
                $billing_detail = new UserBillingDetail();
            }
        }

        $billing_detail->user_id = $user->id;
        $billing_detail->forceFill(request()->only([
          'firstname',
          'lastname',
          'email',
          'company',
          'company_vat',
          'phone',
          'building',
          'street',
          'postcode'
        ]));

        if (request('country_id', false)) {
            $billing_detail->country = Country::find(request('country_id'))->name;
            $billing_detail->region = Region::find(request('region_id'))->name;
            $billing_detail->city = City::find(request('city_id'))->name;
        }

        $billing_detail->save();

        $user->billing_detail;
        $user->shipping_detail;

        if ($validator->fails()) {
            return Response::build($validator->errors()->first(), 500);
        }

        return Response::build($user);
    }

    public function updateShippingDetail()
    {
        $validator = Validator::make(request()->all(), [
        'firstname' => 'required',
        'lastname' => 'required',
        'email' => 'required|email',
        'company' => '',
        'company_vat'  => '',
        'phone' => 'required',
        'country_id' => 'exists:' . config('badass-geolocation.tables.country') . ',id',
        'region_id' => 'exists:' . config('badass-geolocation.tables.region') . ',id',
        'city_id' => 'exists:' . config('badass-geolocation.tables.city') . ',id',
        'building' => '',
        'street' => 'required',
        'postcode' => 'required',
      ]);

        $user = Auth::user();

        if (is_null($user) || is_null($user->shipping_detail)) {
            if (!request('country_id', false)) {
                return Response::build('Country is required', 403);
            }

            if (!request('region_id', false)) {
                return Response::build('Region/state is required', 403);
            }

            if (!request('city_id', false)) {
                return Response::build('City/Town is required', 403);
            }
        }

        if (!Auth::check()) {
            $user = new User();
            $user->firstname = 'Guest';
            $user->lastname = 'Guest';
            $user->email = 'Guest';
            $user->password = 'Guest';
            $user->save();

            $shipping_detail = new UserShippingDetail();
        } else {
            $user = Auth::user();
            $shipping_detail = $user->shipping_detail;

            if (is_null($shipping_detail)) {
                $shipping_detail = new UserShippingDetail();
            }
        }

        $shipping_detail->user_id = $user->id;
        $shipping_detail->forceFill(request()->only([
        'firstname',
        'lastname',
        'email',
        'company',
        'company_vat',
        'phone',
        'building',
        'street',
        'postcode'
      ]));

        if (request('country_id', false)) {
            $shipping_detail->country = Country::find(request('country_id'))->name;
            $shipping_detail->region = Region::find(request('region_id'))->name;
            $shipping_detail->city = City::find(request('city_id'))->name;
        }

        $shipping_detail->save();

        $user->billing_detail;
        $user->shipping_detail;

        if ($validator->fails()) {
            return Response::build($validator->errors()->first(), 500);
        }

        return Response::build($user);
    }
}
