<?php

class Category {
    
    
    public static function getCategoriesList() {

        $db = Db::getConnection();
        
        $result = $db->query('SELECT id, name '
                . 'FROM category '
                . 'ORDER BY sort_order ASC');
        
        $result->setFetchMode(PDO::FETCH_ASSOC);
        
        $categoriesList = [];
        foreach ($result as $key => $value):
            $categoriesList[$key] = $value;
        endforeach;

        return $categoriesList;
    }
}
