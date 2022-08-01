<?php
require_once(__DIR__ .'/header.php');
$app = new Bbs\Controller\UserUpdate();
$app->run();
?>
<div class="l-title">
  <div class="c-title">マイページ</div>
</div>
<div class="l-main l-inner">
  <form method="post" id="userupdate" class="p-mypage" enctype="multipart/form-data">
    <div class="p-mypage__container">
    <div class="p-mypage__block">
      <div class="form-group">
        <label>メールアドレス</label>
        <input type="text" name="email" value="<?= isset($app->getValues()->email) ? h($app->getValues()->email): ''; ?>" class="form-control">
        <p class="err"><?= h($app->getErrors('email')); ?></p>
      </div>
      <div class="form-group">
        <label>ユーザー名</label>
        <input type="text" name="username" value="<?= isset($app->getValues()->username) ? h($app->getValues()->username): ''; ?>" class="form-control">
        <p class="err"><?= h($app->getErrors('username')); ?></p>
      </div>
    </div>
    <div class="p-mypage__block">
      <div class="form-group">
        <div class="imgarea <?= isset($app->getValues()->image) ? '': 'noimage' ?>">
          <label>
            <span class="file-btn">
              編集
              <input type="file" name="image" class="form" style="display:none" accept="image/*">
            </span>
          </label>
          <div class="imgfile">
            <img src="<?= isset($app->getValues()->image) ? './gazou/'. h($app->getValues()->image) : './asset/img/noimage.png'; ?>" alt="">
          </div>
        </div>
      </div>
    </div>
    </div>
    <button class="c-btn" onclick="document.getElementById('userupdate').submit();">更新</button>
      <input type="hidden" name="token" value="<?= h($_SESSION['token']); ?>">
      <input type="hidden" name="old_image" value="<?= h($app->getValues()->image); ?>">
      <p class="err"></p>
  </form>
  <form action="user_delete_confirm.php" method="post" class="c-user__delete">
    <input type="submit" class="c-btn c-btn--delete" value="退会する">
    <input type="hidden" name="token" value="<?= h($_SESSION['token']); ?>">
  </form>
</div><!--container -->
<?php
require_once(__DIR__ .'/footer.php');
?>