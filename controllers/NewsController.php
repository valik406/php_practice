<?php
include_once ROOT . '/models/News.php';
class NewsController{
    
    
    public function actionIndex() {
        $newsList = [];
        $newsList = News::getNewsList();
        
        echo '<pre>';
        print_r($newsList);
        echo '</pre>';
        return true;
    }
    
    public function actionView($id) {
        if($id):
            $newsItem = News::getNewsItemById($id);
            echo '<pre>';
            print_r($newsItem);
            echo '</pre>';
        endif;
        
        echo 'Просмотр Одной новости'.'<br>';

        echo $id.'<br>';
        return true;
    }
}

