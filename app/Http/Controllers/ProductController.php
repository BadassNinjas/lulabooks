<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Base\Controller;
use BadassNinjas\Helpers\Response;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductCategory;

class ProductController extends Controller
{
    public function getProduct($productId)
    {
        if (is_null($productId)) {
            return Response::build('Invalid product ID', 404);
        }
        $product = Product::find($productId);

        if (is_null($product)) {
            return Response::build('Product invalid', 404);
        }

        return Response::build($product);
    }

    public function getProducts()
    {
        return Response::build(Product::paginate(request('per_page', 15)));
    }

    public function createOrUpdateProduct($productId = null)
    {
        $product = Product::updateOrCreate(['id' => $productId], request()->all());

        if (request('category_id', false) && !is_null($product)) {
            if (!is_null($product->category)) {
                while (($category = $product->category) != null) {
                    $category->products()->detach($product->id);
                }
            }

            $category = ProductCategory::find(request('category_id'));

            if ($category->exists()) {
                $product->categories()->attach($category->id);

                while (($category = $category->parent) != null) {
                    $category->products()->attach($product->id);
                }
            }
        }

        return Response::build($product);
    }

    public function attachImage($productId = null)
    {
        $product = Product::find($productId);

        if (is_null($product)) {
            return Response::build('Product invalid', 404);
        }

        $file = request()->file('file')->store('product_images');

        $image = new ProductImage();
        $image->external_id = time();
        $image->path = '/' . $file;
        $image->save();


        $product->images()->attach($image->id);

        return Response::build($product);
    }

    public function deleteProduct($productId)
    {
        $product = Product::find($productId);

        if (!is_null($product)) {
            $product->delete();
        }

        return Response::build();
    }
    public function deleteImage($imageId){

      $image = ProductImage::find($imageId);

      $image->delete();

      return Response::build();
    }
    public function searchProducts($search_term)
    {
        $results = Product::
                      where('name', 'like', '%'.$search_term.'%')
                      ->orWhere('caption', 'like', '%'.$search_term.'%')
                      ->orWhere('detail', 'like', '%'.$search_term.'%')
                      ->get();

        return Response::build([
          'term' => $search_term,
          'results' => $results,
        ]);
    }
}
