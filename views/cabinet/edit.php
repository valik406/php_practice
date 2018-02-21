<?php include ROOT . '/views/layouts/header.php'; ?>
<section><!--form-->
    <div class="container">
        <div class="row">
            <div class="col-sm-4 col-sm-offset-4 padding-right">
                <?php if ($result): ?>
                    <p>Даные отредактированы!</p>
                <?php else: ?>
                    <?php if (isset($errors) && is_array($errors)): ?>
                        <ul style="color: red">
                            <?php foreach ($errors as $error): ?>
                                <li>- <?= $error ?></li>
                            <?php endforeach; ?>

                        </ul>
                    <?php endif; ?>
                    <div class="signup-form"><!--sign up form-->
                        <h2>Редактирование даных</h2>
                        <form action="" method="post">
                            <input type="text" name="name" placeholder="Имя" value="<?= $name ?>"/>
                            <input type="password" name="password" placeholder="Пароль" value="<?= $password ?>"/>
                            <input type="submit" name="submit" class="btn btn-default" value="Сохранить"/>
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

