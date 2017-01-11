<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Base\Controller;
use BadassNinjas\Helpers\Response;
use ShopKit\Product\Models\Product;

class ProductController extends Controller
{
    public function getProducts()
    {
        return BadassResponse::build(Product::paginate(request('per_page', 15)));
    }

    public function createOrUpdateProduct($productId = null)
    {
        return BadassResponse::build(Product::updateOrCreate(['id' => $productId], request()->all()));
    }
}
