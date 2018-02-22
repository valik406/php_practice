<?php include ROOT . '/views/layouts/header.php'; ?>
<section><!--form-->
    <div class="container">
        <div class="row">
            <div class="col-sm-4 col-sm-offset-4 padding-right">
                <?php if ($result): ?>
                    <p>Сообщение отправлено! Мы ответим Вам на указаный email</p>
                <?php else: ?>
                    <?php if (isset($errors) && is_array($errors)): ?>
                        <ul style="color: red">
                            <?php foreach ($errors as $error): ?>
                                <li>- <?= $error ?></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                    <div class="signup-form"><!--sign up form-->
                        <h2>Обратная связь</h2>
                        <form action="" method="post">
                            <input type="email" name="userEmail" placeholder="Email" value="<?= $userEmail ?>"/>
                            <input type="text" name="userText" placeholder="Сообщение" value="<?= $userText ?>"/>
                            <input type="submit" name="submit" class="btn btn-default" value="Отправить"/>
                        </form>
                    </div><!--/sign up form-->
                <?php endif; ?>
                <br>
                <br>
            </div>
        </div>
    </div>
</section><!--/form-->
<?php include ROOT . '/views/layouts/footer.php'; ?>


