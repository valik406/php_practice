<?php


class Cart {
    
    public static function addProduct($id) {
        
        $id = intval($id);
        
        $productsInCart = [];
        
        
        if(isset($_SESSION['products'])){
            $productsInCart = $_SESSION['products'];
        }
        
        if(array_key_exists($id, $productsInCart)){
            $productsInCart[$id]++;
        }else{
            $productsInCart[$id] = 1;
        }
        
        $_SESSION['products'] = $productsInCart;
        
        return self::cauntItems();
    }
    
     public static function cauntItems() {
         
        if (isset($_SESSION['products'])):
            
            $count = 0;
        
            foreach ($_SESSION['products'] as $id => $quantity):
                $count = $count + $quantity;
            endforeach;
            
            return $count;
        else:
            return 0;
        endif;
    }
    
    public static function getProducts() {
         
        if (isset($_SESSION['products'])):
            
            return $_SESSION['products'];
        
        endif;
        
        return false;
    }    
    
    public static function deleteProduct($id) {
         $id = intval($id);
         unset($_SESSION['products'][$id]);
    }    
    
        public static function getTotalPrice($products) {
         
        $productsInCart = self::getProducts();
        $total = 0;
        
        if($productsInCart){
            foreach ($products as $item){
                $total += $item['price'] * $productsInCart[$item['id']]; 
            }
        }
        
        return $total;
    }  

    
    public static function clear() {
        if (isset($_SESSION['products'])):
            unset($_SESSION['products']);
        endif;
    }        
}
