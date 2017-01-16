<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Base\Controller;
use BadassNinjas\Helpers\Response;
use ShopKit\Product\Models\Product;
use ShopKit\Product\Models\ProductImage;
use BadassNinjas\RFS\Facades\RFS;

class RenderProductController extends Controller
{
    public function getRenderProducts()
    {
        return Response::build(Product::get());
    }
}
