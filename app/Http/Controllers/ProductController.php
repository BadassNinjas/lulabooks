<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Base\Controller;
use BadassNinjas\Helpers\Response;
use ShopKit\Product\Models\Product;
use ShopKit\Product\Models\ProductImage;
use BadassNinjas\RFS\Facades\RFS;

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

    public function attachImage($productId = null)
    {
        $product = Product::find($productId);

        if (is_null($product)) {
            return Response::build('Product invalid', 404);
        }

        $media = RFS::uploadMediaFromRequest('file');

        if ($media) {
            $media = (object) $media;

            $image = new ProductImage();
            $image->external_id = time();
            $image->hostname = $media->payload->host;
            $image->path = $media->payload->path;
            $image->save();

            $product->images()->attach($image->id);

            return Response::build($product);
        }

        return Response::build('Failed to upload image', 500);
    }
}
