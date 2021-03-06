<?php

class CabinetController {

    public function actionIndex() {
        $userId = User::checkLogged();
        
        $user = User::geUserById($userId);
        
        require_once ROOT . '/views/cabinet/index.php';

        return true;
    }
    
    public function actionEdit() {
        $userId = User::checkLogged();
        
        $user = User::geUserById($userId);
        
        $name = $user['name'];
        $password = $user['password'];
        
        $result = false;

        if (isset($_POST['submit'])):
            $name = $_POST['name'];
            $password = $_POST['password'];

            $errors = false;

            if (!User::checkName($name)) {
                $errors[] = 'Имя не должно быть короче 2-х символов!';
            }

            if (!User::checkPassword($password)) {
                $errors[] = 'Пароль не должно быть короче 6-и символов!';
            }

            if ($errors == false):
                $result = User::edit($userId, $name, $password);
            endif;

        endif;
        
        require_once ROOT . '/views/cabinet/edit.php';

        return true;
    }

}
