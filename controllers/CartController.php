<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CartController
 *
 * @author Admin
 */
class CartController {
    
    public function actionAdd($id) {
        
        Cart::addProduct($id);
        
        $referrer = $_SERVER['HTTP_REFERER'];
        header("Location: $referrer");
    }
    
    public function actionAddAjax($id) {
        
        echo Cart::addProduct($id);
        
        return true;
    }
    
    public function actionIndex() {
        
        $categories = [];
        $categories = Category::getCategoriesList();
        
        $productsInCart = false;
        
        $productsInCart = Cart::getProducts();
        
        if($productsInCart){
            $productsIds = array_keys($productsInCart);
            $products = Product::getProductByIds($productsIds);
            
            $totalPrice = Cart::getTotalPrice($products);
        }
        
        require_once ROOT . '/views/cart/index.php';
        
        return true;
    }
}
