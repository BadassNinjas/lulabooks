<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Base\Controller;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductImage;
use App\Helpers\Response;
use BadassNinjas\RFS\Facades\RFS;
use Illuminate\Support\Facades\Cache;

class RenderController extends Controller
{
    public function getRenderProducts()
    {
        return Response::build(Product::paginate(12));
    }

    public function getRenderProductsOnCategory($category_id)
    {
        $ProductCategory = ProductCategory::find($category_id)->products()->paginate(9);
        

        return Response::build($ProductCategory);
    }

    public function getWorldCountries()
    {
        $countries = Cache::get('geo.countries', Country::orderBy('name', 'ASC')->whereHas('regions')->get());

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
