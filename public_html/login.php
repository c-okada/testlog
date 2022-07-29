<?php
require_once(__DIR__ .'/header.php');
$app = new Bbs\Controller\Login();
$app->run();
?>

<div class="p-login l-inner">
  <form action="" method="post" id="login" class="p-login__forms">
    <div class="p-login__form">
      <label>メールアドレス</label>
      <input type="text" name="email" value="<?= isset($app->getValues()->email) ? h($app->getValues()->email) : ''; ?>" id="p-login__form-control">
    </div>
    <div class="p-login__form">
      <label>パスワード</label>
      <input type="password" name="password" id="p-login__form-control">
    </div>
    <p class="err"><?= h($app->getErrors('login')); ?></p>
    <div class="p-login__btn">
      <button class="c-btn" onclick="document.getElementById('login').submit();">ログイン</button>
    </div>
    <input type="hidden" name="token" value="<?= h($_SESSION['token']); ?>">
  </form>
</div><!--container -->

<?php require_once(__DIR__ .'/footer.php'); ?>