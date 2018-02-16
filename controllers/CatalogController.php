<?php
include_once ROOT . '/models/Category.php';
include_once ROOT . '/models/Product.php';

class CatalogController {
    
    public function actionIndex() {
        
        $categories = [];
        $categories = Category::getCategoriesList();
        
        $latestProducts = [];
        $latestProducts = Product::getLatesProducts(12);
        
        require_once ROOT . '/views/catalog/index.php';
        
        return true;
    }
    
        public function actionCategory($categoryId) {
        
        $categories = [];
        $categories = Category::getCategoriesList();
        
        $categoryProducts = [];
        $categoryProducts = Product::getProductsListByCategory($categoryId);
        
        require_once ROOT . '/views/catalog/category.php';
        
        return true;
    }
}
