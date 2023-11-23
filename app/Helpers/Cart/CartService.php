<?php

namespace App\Helpers\Cart;

use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class CartService {
    protected $cart;
    protected $name = "default";

    public function __construct() {
        $this->cart = session()->get($this->name) ?? collect([]);
    }

    public function put(array $value, $obj = null) {
        if(!is_null($obj) && $obj instanceof Model) {
            $value = array_merge($value, [
                'id' => Str::random(10),
                'subject_id' => $obj->id,
                'subject_type' => get_class($obj)
            ]);

            // این بخش رو بعدا خودم برای محاسبه و جایگزین کردن محدودیت تعداد محصول اضافه کردم
            $value = array_merge($value,[
                'quantity' => $this->productQuantityLimitPut($obj,$value['quantity'])
            ]);

        } elseif(!isset($value['id'])) {
            $value = array_merge($value,[
                'id' => Str::random(10)
            ]);
        }
        
        $this->cart->put($value['id'], $value);
        session()->put($this->name, $this->cart); 

        return $this;
    }

    public function update($key,$options) {
        $item = collect($this->get($key,false));

        if(is_numeric($options)) {
            $item = $item->merge([
                'quantity' => $this->productQuantityLimitUpdate($key,$options)
            ]);
        }

        if(is_array($options)) {

            $item = $item->merge($options);

            $item = $item->merge([
                'quantity' => $this->productQuantityLimitUpdate($key,$options)
            ]);
        }

        $this->put($item->toArray());

        //return $this;
        return $item;
    }

    // محاسبه محدودیت تعداد محصول برای محصولی که برای اولین بار در سبد خرید قرار میگیرد
    public function productQuantityLimitPut($key,$quantity) {

        if($key->determine_product_min() != NULL && ($quantity < $key->determine_product_min())) {
            $quantity = $key->determine_product_min();
        } elseif($key->determine_product_max() != NULL && ($quantity > $key->determine_product_max())) {
            $quantity = $key->determine_product_max();
        }

        return $quantity;
    }

    // محاسبه محدودیت تعداد محصول برای محصولی که قبلا داخل سبد خرید گذاشته شده است
    public function productQuantityLimitUpdate($key,$options) {

        $item = collect($this->get($key,false));
        $product = Product::find($item['subject_id']);

        if(is_numeric($options)) {
            $quantity = $item['quantity'] + $options;
        } elseif(is_array($options)) {
            $quantity = $options['quantity'];
        }
        
        
        if($product->determine_product_min() && ($quantity < $product->determine_product_min())) {
            $quantity = $product->determine_product_min();
        } elseif($product->determine_product_max() && ($quantity > $product->determine_product_max())) {
            $quantity = $product->determine_product_max();
        }

        return $quantity;
    }

    public function count($key) {
        if(!$this->has($key)) return 0;
        
        return $this->get($key)['quantity'];
    }

    public function countCartItems() {
        return $this->cart->count();
    }

    public function has($key) {
        if($key instanceof Model) {
            return !is_null($this->cart->where('subject_id',$key->id)->where('subject_type',get_class($key))->first());
        } 

        return !is_null($this->cart->where('id',$key)->first());
    }

    public function get($key,$withRelationShip = true) {
        $item = $key instanceof Model ? $this->cart->where('subject_id',$key->id)->where('subject_type',get_class($key))->first() : $this->cart->firstWhere('id',$key);

        return $withRelationShip ? $this->withRelationshipIfExists($item) : $item;
    }

    public function delete($key) {
        if($this->has($key)) {
            $this->cart = $this->cart->filter(function($item) use($key) {
                if($key instanceof Model) {
                    return($item['subject_id'] != $key->id) && ($item['subject_type'] != get_class($key));
                }
                return $key != $item['id'];
            });
            session()->put($this->name,$this->cart);
            return true;
        }
        return false;
    }

    public function deleteAll() {
        session()->put($this->name,null);
        return true;
    }

    public function all() {
        $cart = $this->cart;
        $cart = $cart->map(function($item) {
            return $this->withRelationshipIfExists($item);
        });

        return $cart;
    }

    protected function withRelationshipIfExists($item) {
        if(isset($item['subject_id']) && isset($item['subject_type'])) {
            $class = $item['subject_type'];
            $subject = (new $class())->find($item['subject_id']);
            $item[strtolower(class_basename($class))] = $subject;
            unset($item['subject_id']);
            unset($item['subject_type']);
            return $item;
        }

        return $item;
    }

    public function instance(string $name) {
        $this->cart = session()->get($name) ?? collect([]);
        $this->name = $name;
        return $this;
    }

    public function flush() {
        $this->cart = collect([]);
        session()->put($this->name,$this->cart);

        return $this;
    }

}

