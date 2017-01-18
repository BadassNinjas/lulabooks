<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Base\Controller;
use BadassNinjas\Helpers\Response;
use ShopKit\Product\Models\Product;
use ShopKit\Product\Models\ProductImage;
use BadassNinjas\RFS\Facades\RFS;
use BadassNinjas\Geo\Models\Country;
use BadassNinjas\Geo\Models\Region;
use Illuminate\Support\Facades\Cache;

class RenderController extends Controller
{
    public function getRenderProducts()
    {
        return Response::build(Product::get());
    }

    public function getWorldCountries()
    {
        $countries = Cache::get('geo.countries', Country::orderBy('name', 'ASC')->get());

        Cache::put('geo.countries', $countries, 3600);

        return Response::build($countries);
    }

    public function getRegionsOnCountry($country_id)
    {
        $country = Country::find($country_id);

        return Response::build($country->regions()->orderBy('name', 'ASC')->get());
    }

    public function getCitiesOnRegion($region_id)
    {
        $region = Region::find($region_id);

        return Response::build($region->cities()->orderBy('name', 'ASC')->get());
    }
}
