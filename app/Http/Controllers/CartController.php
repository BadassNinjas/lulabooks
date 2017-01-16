<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Base\Controller;
use BadassNinjas\Helpers\Response;
use ShopKit\Core\Facades\ShopKit;
use ShopKit\Product\Models\Product;

class CartController extends Controller
{
    public function getShoppingCart()
    {
        return Response::build([
          'items' => ShopKit::getShoppingCart()->getItems(),
          'total' => ShopKit::getShoppingCart()->getPriceTotal()
        ]);
    }

    public function addToShoppingCart()
    {
        $validator = Validator::make(request()->all(), [
          'id' => 'exists:product,id',
          'qty' => 'min:1'
        ]);

        if ($validator->fails()) {
            return Response::build('Invalid API Usage', 403);
        }

        $product = Product::find(request('id'));

        ShopKit::getShoppingCart()
                   ->addItem(ShopKit::getShoppingCart()
                                           ->createItem()
                                           ->setId($product->id)
                                           ->setName($product->name)
                                           ->setQuantity(request('qty'))
                                           ->setPrice($product->price)
                                           ->setOriginalItem($product)
                                           ->setMisc([
                                             'description' => $product->description,
                                             'image' => count($product->images) ? 'https://' . $product->images->first()->hostname . $product->images->first()->path : '/img/customer/box.jpg'
                                           ]));


        return $this->getShoppingCart();
    }

    public function removeShoppingCartItem($productId)
    {
        $validator = Validator::make(['id' => $productId], [
          'id' => 'exists:product,id'
        ]);

        if ($validator->fails()) {
            return Response::build('Invalid API Usage', 403);
        }

        ShopKit::getShoppingCart()->removeItem(ShopKit::getShoppingCart()->createItem()->setId($productId));

        return $this->getShoppingCart();
    }
}
