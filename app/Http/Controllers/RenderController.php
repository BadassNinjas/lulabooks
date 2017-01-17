<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Base\Controller;
use BadassNinjas\Helpers\Response;
use ShopKit\Product\Models\Product;
use ShopKit\Product\Models\ProductImage;
use BadassNinjas\RFS\Facades\RFS;
use BadassNinjas\Geo\Models\Country;
use BadassNinjas\Geo\Models\Region;

class RenderController extends Controller
{
    public function getRenderProducts()
    {
        return Response::build(Product::get());
    }

    public function getWorldCountries()
    {
        return Response::build(Country::orderBy('name', 'ASC')->get());
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
