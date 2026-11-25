<?php

namespace App\Models;


class Cart
{
    public $items = null;
    public $price = 0;
    public $quantity = 0;
    public function __construct($oldCart, $price){
        //dd($price);
        if ($oldCart) {
            $this->items = $oldCart->items;
            $this->price = $price;
            $this->quantity = $oldCart->quantity;
        }
    }

    public function add($price, $id)
    {
        //dd($price);
        $storedItem = [
            'qty' => 0,
            'price' => $price,
            'campaignId' => $id,

        ];

        if ($this->items){
            if (array_key_exists($id, $this->items)){
                $storedItem = $this->items[$id];
            }
        }
        $storedItem['qty']++;
        $storedItem['price'] = $price * $storedItem['qty'];
        $this->items[$id] = $storedItem;
        $this->quantity++;
        $this->price += $price;

        //dd($this->items);
    }
}
