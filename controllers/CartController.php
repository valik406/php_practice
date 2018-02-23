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

        if ($productsInCart) {
            $productsIds = array_keys($productsInCart);
            $products = Product::getProductByIds($productsIds);

            $totalPrice = Cart::getTotalPrice($products);
        }

        require_once ROOT . '/views/cart/index.php';

        return true;
    }

    public function actionDelete($id) {

        Cart::deleteProduct($id);

        $referrer = $_SERVER['HTTP_REFERER'];
        header("Location: $referrer");
    }

    public function actionCheckout() {

        $categories = [];
        $categories = Category::getCategoriesList();

        $result = false;

        if (isset($_POST['submit'])) {
            $name = $_POST['name'];
            $phone = $_POST['phone'];
            $message = $_POST['message'];

           $errors = false;

            if (!User::checkName($name)) {
                $errors[] = 'Неправельное имя!';
            }
            if (!User::checkPhone($phone)) {
                $errors[] = 'Неправельный номер телефона!';
            } 
            
            if($errors == false){
                $productsInCart = Cart::getProducts();
                
                if(User::isGuest()){
                    $userId = false; 
                } else {
                    $userId = User::checkLogged();
                }
                
                $result = Order::save($name, $phone, $message, $userId, $productsInCart);
                
                if($result){
                    $adminMail = 'valik406@gmail.com';
                    $subject = 'Новый заказ';
                    $message = 'http://record.zzz.com.ua/admin/orders';
                    $headers = "From: support@record.zzz.com.ua \r\n";
                    mail($adminMail, $subject, $message, $headers);
                    
                    Cart::clear();
                }
                
            } else {
                $productsInCart = Cart::getProducts();
                $productIds = array_keys($productsInCart);
                $products = Product::getProductByIds($productIds);
                $totalPrice = Cart::getTotalPrice($products);
                $totalQuantyti = Cart::cauntItems();
            }
            
            
        } else {
            
            
            $productsInCart = Cart::getProducts();
            
            if($productsInCart == false){
                
                header("Location: /");
            } else {
                $productIds = array_keys($productsInCart);
                $products = Product::getProductByIds($productIds);
                $totalPrice = Cart::getTotalPrice($products);
                $totalQuantyti = Cart::cauntItems();
                
                $name = '';
                $phone = '+380';
                $message = '';
                
                if(!User::isGuest()){
                    $userId = User::checkLogged();
                    $user = User::geUserById($userId);
                    $name = $user['name'];
                }
                
            }
            
        }


//        $name = '';
//        $telephone = '';
//        $message = '';

        require_once ROOT . '/views/cart/checkout.php';

        return true;
    }

}
