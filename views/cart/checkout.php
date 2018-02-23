<?php include ROOT . '/views/layouts/header.php'; ?>
<section><!--form-->
    <div class="container">
        <div class="row">

            <div class="col-sm-3">
                <div class="left-sidebar">
                    <h2>Каталог</h2>
                    <div class="panel-group category-products">
                        <?php foreach ($categories as $category): ?>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a href="/category/<?= $category['id'] ?>" 
                                           class="<?php
                                           if ($categoryId == $category['id']) {
                                               echo 'active';
                                           }
                                           ?>">
                                               <?= $category['name'] ?>
                                        </a>
                                    </h4>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>


            <div class="col-sm-4 padding-left">
                <div class="features_items"><!--features_items-->
                    <h2 class="title text-center">Корзина</h2>
                    <?php if ($result): ?>
                        <p>Заказ оформлен. Мы Вам передзвоним</p>
                    <?php else: ?>
                        <p>Выбрано <?= $totalQuantyti ?> товаров, на сумму <?=$totalPrice?> $.</p> 
                        <p>Для оформления заказа заполнети форму. Наш менеджер свяжытся с Вами.</p>
                        <?php if (isset($errors) && is_array($errors)): ?>
                            <ul style="color: red">
                                <?php foreach ($errors as $error): ?>
                                    <li>- <?= $error ?></li>
                                <?php endforeach; ?>

                            </ul>
                        <?php endif; ?>
                        <div class="signup-form"><!--sign up form-->
                            <form action="" method="post">
                                <p>Имя</p>
                                <input type="text" name="name" placeholder="Имя" value="<?= $name ?>"/>
                                <p>Телефон</p>
                                <input type="namber"  name="phone" placeholder="Телефон" value="<?= $phone ?>"/>
                                <p>Коментарий</p>
                                <input type="text" name="message" placeholder="Сообщение" value="<?= $message ?>"/>
                                <input type="submit" name="submit" class="btn btn-default" value="Оформить"/>
                            </form>
                        </div><!--/sign up form-->
                    <?php endif; ?>
                    <br>
                    <br>
                </div>
            </div>
        </div>
    </div>
</section><!--/form-->
<?php include ROOT . '/views/layouts/footer.php'; ?>

