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
        return Response::build(Product::paginate(request('per_page', 15)));
    }

    public function createOrUpdateProduct($productId = null)
    {
        $product = Product::updateOrCreate(['id' => $productId], request()->all());

        if (request('category_id', false) && !is_null($product)) {
            if (!is_null($product->category)) {
                $product->category()->detach($product->category->id);
            }

            $product->categories()->attach(request('category_id'));
        }

        return Response::build($product);
    }
}
