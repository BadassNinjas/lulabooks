<?php
namespace ShopKit\Core\Cart;

class ShopKitCart
{
    private $cartId;
    private $items;
    private $priceTotal;

    public function __construct()
    {
        $this->cartId = time();
        $this->items = [];
        $this->updatePriceTotal();
    }

    public function createItem()
    {
          return new ShopKitCartItem();
    }

    public function addItem(ShopKitCartItem $item)
    {
        $existingItem = $this->getItems()->where('id', $item->getId());
        if (!$existingItem->count()) {
            $this->items = $this->getItems()->push($item);
        } else {
            $this->getItems()->transform(function ($olditem, $key) use ($item) {
                if ($olditem->getId() == $item->getId()) {
                    return $olditem->setQuantity($olditem->getQuantity()+$item->getQuantity());
                }
                return $olditem;
            });
        }
        $this->updatePriceTotal();
    }

    public function removeItem($item_id)
    {
        $this->items = $this->getKeyedItems()->forget($item_id);
        $this->updatePriceTotal();
    }

    public function updateItem(ShopKitCartItem $item)
    {
        $this->items->transform(function ($olditem, $key) use ($item) {
            if ($olditem->getId() == $item->getId()) {
                return $item;
            }
            return $olditem;
        });
        $this->updatePriceTotal();
    }

    public function emptyCart()
    {
        $this->items = collect([]);
        $this->updatePriceTotal();
    }

    private function getKeyedItems()
    {
        return $this->getItems()->keyBy(function ($item) {
            return $item->getId();
        });
    }

    public function getItems()
    {
        return collect($this->items);
    }

    public function getPriceTotal()
    {
        return $this->priceTotal;
    }

    private function updatePriceTotal()
    {   
        $this->priceTotal = $this->getItems()->sum(function ($item) {
            return ($item->getPrice()*($item->getQuantity()*$item->getGrade()));
        });
    }
}
