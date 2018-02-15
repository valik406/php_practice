<?php
include_once ROOT . '/components/Db.php';

class News {

    /**
     * Returns single news item with specified id
     * @param integer $id
     */
    public static function getNewsItemById($id) {
        $id = intval($id);
        if ($id):
            
            $db = Db::getConnection();

            $result = $db->query('SELECT * from news WHERE id=' . $id);
            $result->setFetchMode(PDO::FETCH_ASSOC);
            $newsItem = $result->fetch();

            return $newsItem;
        endif;
    }

    /**
     *  Return an array of news items
     */
    public static function getNewsList() {

        $db = Db::getConnection();
        
        $result = $db->query('SELECT id, title, date, short_content '
                . 'FROM news '
                . 'ORDER BY date DESC '
                . 'LIMIT 10');
        $result->setFetchMode(PDO::FETCH_ASSOC);
        
        $newsList = [];
        foreach ($result as $key => $value):
            $newsList[$key] = $value;
        endforeach;

        return $newsList;
    }

}
