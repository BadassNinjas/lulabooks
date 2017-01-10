<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Base\Controller;
use BadassNinjas\Utils\BadassResponse;
use ShopKit\Core\Facades\ShopKit;

class CartController extends Controller
{
    public function getShoppingCart()
    {
        return BadassResponse::build([
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
            return BadassResponse::build('Invalid API Usage', 403);
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
                                             'image' => 'http://wallpaper-gallery.net/images/nice-picture/nice-picture-13.jpg'
                                           ]));


        return $this->getBasket();
    }
}
