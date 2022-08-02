<?php
require_once(__DIR__ .'/header.php');
$app=new Bbs\Controller\UserDelete();
$app->run();
?>
<div class="l-title">
  <p class="c-title">ユーザー退会</p>
</div>

<div class="l-main l-inner">
  <p class="user-disp">以下のユーザーを退会します。<br>実行する場合は「退会」ボタンを押してください。</p>
  <div class="p-delete">
      <div class="p-delete__text">
        <p>メールアドレス：<?= isset($app->getValues()->email) ? h($app->getValues()->email): ''; ?></p>
      </div>
      <div class="p-delete__text">
        <p>ユーザー名：<?= isset($app->getValues()->username) ? h($app->getValues()->username): ''; ?></p>
      </div>
    <form class="p-delete__form" action="user_delete_done.php" method="post">
      <a class="c-btn c-btn--taikai" href="javascript:history.back();">まだしません</a>
      <input type="submit" class="c-btn c-btn--taikai" value="退会">
      <input type="hidden" name="token" value="<?= h($_SESSION['token']); ?>">
      <input type="hidden" name="type" value="delete">
    </form>
  </div><!--container -->
</div>
<?php
  require_once(__DIR__ .'/footer.php');
  ?>
