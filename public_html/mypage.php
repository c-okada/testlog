<?php
require_once(__DIR__ .'/header.php');
$app = new Bbs\Controller\UserUpdate();
$app->run();
// var_dump($app);
// exit;
?>
<div class="l-title">
  <div class="c-title">マイページ</div>
</div>
<div class="l-main l-inner">
  <form method="post" id="userupdate" class="p-mypage" enctype="multipart/form-data">
    <div class="p-mypage__container">
      <div class="p-login__forms">
        <div class="p-login__form">
          <label>メールアドレス</label>
          <input type="email" name="email" value="<?= isset($app->getValues()->email) ? h($app->getValues()->email): ''; ?>" id="p-login__form-control">
          <p class="err"><?= h($app->getErrors('email')); ?></p>
        </div>
        <div class="p-login__form">
          <label>ユーザー名</label>
          <input type="text" name="username" value="<?= isset($app->getValues()->username) ? h($app->getValues()->username): ''; ?>" id="p-login__form-control">
          <p class="err"><?= h($app->getErrors('username')); ?></p>
        </div>
      </div>
      <div class="p-mypage__block">
          <div class="imgarea <?= isset($app->getValues()->image) ? '': 'noimage' ?>">
            <label for="c-file" class="c-file__img">
              <img src="<?= isset($app->getValues()->image) ? './asset/img/'. h($app->getValues()->image) : './asset/img/noimage.png'; ?>" alt="">
            </label>
            <p class="file-btn">
              <input type="file" id="c-file" name="image" class="c-file" style="display:none" accept="image/*">
            </p>
          </div>
      </div>
    </div>
    <div class="p-mypage__btn">
      <button class="c-btn" onclick="document.getElementById('userupdate').submit();">更新</button>
        <input type="hidden" name="token" value="<?= h($_SESSION['token']); ?>">
        <input type="hidden" name="old_image" value="<?= h($app->getValues()->image); ?>">
        <input type="hidden" name="username" value="<?= h($app->getValues()->username); ?>">
        <input type="hidden" name="email" value="<?= h($app->getValues()->email); ?>">
        <p class="err"></p>
    </div>
  </form>
  <form action="user_delete_confirm.php" method="post" class="c-user__delete">
    <input type="submit" class="c-btn c-btn--delete" value="退会する">
    <input type="hidden" name="token" value="<?= h($_SESSION['token']); ?>">
  </form>
</div><!--container -->
<?php
require_once(__DIR__ .'/footer.php');
?>