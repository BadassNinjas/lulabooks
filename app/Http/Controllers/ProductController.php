<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Base\Controller;
use App\Helpers\Response;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\BookProduct;
use App\Models\StationeryProduct;
use App\Models\ProductCategory;
use Illuminate\Support\Facades\Validator;
use Log;

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

    public function getFeatured(){

        $products = Product::where('featured','=','1')->get();

        if(is_null($products)){
            Response::build('no featured products');
        }

        return Response::build($products);
    }

    public function findAssocProduct($productId){

        $product = Product::find($productId);
        
        if(!is_null($product)){
            if($product->type === 'book'){
                $bookproduct = BookProduct::where('product_id','=',$product->id)->where('grade','=','new')->first();
    
                return Response::build($bookproduct);
            }
            else{
                $stationeryproduct = StationeryProduct::where('product_id','=',$product->id)->first();
    
                return Response::build($stationeryproduct);
            }
        }

        return Response::build('failed to find product');
    }

    public function getProducts()
    {
        return Response::build(Product::paginate(request('per_page', 15)));
    }

    public function createOrUpdateProduct($productId = null)
    {
        $product = Product::updateOrCreate(['id' => $productId],request('product'));
        Log::info('our product '.$product);
        
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

        $product->type = request('product')['type'];
        $product->save();

        $grade = request('grade');

        if($product->type === 'book'){
    
            if(!is_null($grade)){
              $bookproduct = BookProduct::updateOrCreate(['product_id'=>$product->id,'grade'=>$grade]);
              $bookproduct->in_stock = (int)request('in_stock');
              $bookproduct->save();
              Log::info($bookproduct);
            }
            else {
                $bookproduct = BookProduct::updateOrCreate(['product_id'=>$product->id,'grade'=>'new']);
                $bookproduct->in_stock = (int)request('in_stock');
                $bookproduct->save();
                Log::info($bookproduct);
            }

        }
        else{
            Log::info('type'. $product->type);
            $stationeryproduct = StationeryProduct::updateOrCreate(['product_id'=>$product->id]);
            $stationeryproduct->in_stock = request('in_stock');
            $stationeryproduct->save();
        }


        return Response::build($product);
    }
    public function checkAvailability($productId,$grade){

          $product = Product::find($productId);
          $productAvailableCount = 0;

          if(!is_null($product)){
            if($product->type === 'stationery'){
                $productAvailableCount = StationeryProduct::where('product_id','=',$product->id)->first()->in_stock;
                
              }
              else{
                $bookproduct = $product->bookproduct()->where('product_id','=',$product->id)->get();
    
                switch ($grade) {
                  case '0.9':
                    if(!is_null($bookproduct->where('grade','=','A-GRADE')->first())){
                      $productAvailableCount = $product->bookproduct()->where('grade','=','A-GRADE')->first()->in_stock;
                    }
    
                    break;
                  case '0.85':
                    if(!is_null($bookproduct->where('grade','=','B-GRADE')->first())){
                      $productAvailableCount = $product->bookproduct()->where('grade','=','B-GRADE')->first()->in_stock;
                    }
                    break;
                  default:
                    if(!is_null($bookproduct->where('grade','=','new')->first())){
                      $productAvailableCount = $product->bookproduct()->where('grade','=','new')->first()->in_stock;
                    }
                    break;
                }
    
              }
              Log::info($productAvailableCount);
          }

          return Response::build((int)$productAvailableCount);
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
