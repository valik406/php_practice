<?php

class Product {

    const SHOW_BY_DEFAULT = 3;

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

    public static function getProductsListByCategory($categoryId, $page = 1) {

        if ($categoryId):
            $page = intval($page);
            $offset = ($page - 1) * self::SHOW_BY_DEFAULT;

            $db = Db::getConnection();

            $result = $db->query('SELECT id, name, price, image, is_new '
                    . 'FROM product '
                    . "WHERE status = '1' AND category_id = '$categoryId' "
                    . 'ORDER BY id DESC '
                    . 'LIMIT ' . self::SHOW_BY_DEFAULT
                    . ' OFFSET ' . $offset);

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

    public static function getTotalProductsInCategory($categoryId) {

        
        $db = Db::getConnection();

        $result = $db->query('SELECT count(id) AS count FROM product '
                . 'WHERE status = "1" AND category_id = "'.$categoryId.'"');
        $result->setFetchMode(PDO::FETCH_ASSOC);

        $row = $result->fetch();
        
        return $row['count'];
    }
    
    public static function getProductByIds($productIds) {

        $db = Db::getConnection();
        $idsString = implode(",", $productIds);
        
        $sql = "SELECT * FROM product WHERE status = '1' AND id IN ($idsString)";
        
        $result = $db->query($sql);
        $result->setFetchMode(PDO::FETCH_ASSOC);

        $products = [];
        foreach ($result as $key => $value):
            $products[$key] = $value;
        endforeach;

        return $products;
    }    

}
