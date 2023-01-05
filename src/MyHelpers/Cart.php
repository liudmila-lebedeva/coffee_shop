<?php

namespace App\MyHelpers;

class Cart{
    private $cart = array();
    
    public function addItem($id){
        if(array_key_exists($id, $this->cart)){
            $this->cart[$id]++ ;
        }  else {
            $this->cart[$id] = 1;
        }
    }
    
    public function getItems(){
        return $this->cart;
    }
}