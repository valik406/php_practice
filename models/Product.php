<?php

class Product {

    const SHOW_BY_DEFAULT = 10;

    public static function getLatesProducts($count = self::SHOW_BY_DEFAULT) {
        $count = intval($count);

        $db = Db::getConnection();

        $result = $db->query('SELECT id, name, price, image, is_new '
                . 'FROM product '
                . 'WHERE status = "1"'
                . 'ORDER BY id DESC '
                . 'LIMIT ' . $count);

        $result->setFetchMode(PDO::FETCH_ASSOC);

        $productsList = [];
        foreach ($result as $key => $value):
            $productsList[$key] = $value;
        endforeach;

        return $productsList;
    }

    public static function getProductsListByCategory($categoryId) {

        if ($categoryId):
            $db = Db::getConnection();

            $result = $db->query('SELECT id, name, price, image, is_new '
                    . 'FROM product '
                    . "WHERE status = '1' AND category_id = '$categoryId' "
                    . 'ORDER BY id DESC '
                    . 'LIMIT ' . self::SHOW_BY_DEFAULT);

            $result->setFetchMode(PDO::FETCH_ASSOC);

            $productsList = [];
            foreach ($result as $key => $value):
                $productsList[$key] = $value;
            endforeach;

            return $productsList;
        endif;
    }

    
        public static function getProductById($productId) {

        if ($productId):
            $db = Db::getConnection();

            $result = $db->query('SELECT * FROM product WHERE id=' . $productId);
            $result->setFetchMode(PDO::FETCH_ASSOC);

            return $result->fetch();
        endif;
    }
}
