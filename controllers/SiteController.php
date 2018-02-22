<?php


class SiteController {

    public function actionIndex() {
        
        $categories = [];
        $categories = Category::getCategoriesList();
        
        $latestProducts = [];
        $latestProducts = Product::getLatesProducts(3);
        
        require_once ROOT . '/views/site/index.php';
        
        return true;
    }
    
    public function actionContact() {
        $userEmail = '';
        $userText = '';
        $result = false;
        
        if(isset($_POST['submit'])):
            $userEmail = $_POST['userEmail'];
            $userText = $_POST['userText'];
            
            $errors = false;
            
            if(!User::checkEmail($userEmail)):
                $errors[] = 'Неправельный email';
            endif;
            
            if($errors == false):
                $adminMail = 'valik406@gmail.com';
                $subject = 'Обратная связь от интернет магазина';
                $message = 'Текст: ' . $userText . ' От: ' . $userEmail;
                $headers = "From: support@record.zzz.com.ua \r\n";

                $result = mail($adminMail, $subject, $message, $headers);
            endif;
        endif;
        
        
        require_once ROOT . '/views/site/contact.php';
        
        return true;
    }

}
