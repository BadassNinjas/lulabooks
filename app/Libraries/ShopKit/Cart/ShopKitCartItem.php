<?php
namespace ShopKit\Core\Cart;

class ShopKitCartItem
{
    public $id;
    public $name;
    public $quantity;
    public $price;
    public $misc;
    public $originalItem;
    /**
     * Get the value of Id
     *
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }
    /**
     * Set the value of Id
     *
     * @param mixed id
     *
     * @return self
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }
    /**
     * Get the value of Name
     *
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }
    /**
     * Set the value of Name
     *
     * @param mixed name
     *
     * @return self
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }
    /**
     * Get the value of Quantity
     *
     * @return mixed
     */
    public function getQuantity()
    {
        return $this->quantity;
    }
    /**
     * Set the value of Quantity
     *
     * @param mixed quantity
     *
     * @return self
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
        return $this;
    }
    /**
     * Get the value of Price
     *
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }
    /**
     * Set the value of Price
     *
     * @param mixed price
     *
     * @return self
     */
    public function setPrice($price)
    {
        $this->price = $price;
        return $this;
    }
    /**
     * Get the value of Attachments
     *
     * @return mixed
     */
    public function getMisc()
    {
        return $this->misc;
    }
    /**
     * Set the value of Attachments
     *
     * @param mixed misc
     *
     * @return self
     */
    public function setMisc($misc)
    {
        $this->misc = $misc;
        return $this;
    }
    /**
     * Get the value of Original Item
     *
     * @return mixed
     */
    public function getOriginalItem()
    {
        return $this->originalItem;
    }
    /**
     * Set the value of Original Item
     *
     * @param mixed originalItem
     *
     * @return self
     */
    public function setOriginalItem($originalItem)
    {
        $this->originalItem = $originalItem;
        return $this;
    }
}
