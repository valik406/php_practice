<?php

class CatalogController {
    
    public function actionIndex() {
        
        $categories = [];
        $categories = Category::getCategoriesList();
        
        $latestProducts = [];
        $latestProducts = Product::getLatesProducts(12);
        
        require_once ROOT . '/views/catalog/index.php';
        
        return true;
    }
    
        public function actionCategory($categoryId, $page = 1) {
        
        $categories = [];
        $categories = Category::getCategoriesList();
        
        $categoryProducts = [];
        $categoryProducts = Product::getProductsListByCategory($categoryId, $page);
        
        $total = Product::getTotalProductsInCategory($categoryId);
        
        $pagination = new Pagination($total, $page, Product::SHOW_BY_DEFAULT, 'page-');
        
        require_once ROOT . '/views/catalog/category.php';
        
        return true;
    }
}
