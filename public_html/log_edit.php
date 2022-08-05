<?php
require_once(__DIR__ .'/header.php');
$app=new Bbs\Controller\LogEdit();
$app->run($_POST['logedit']);
// var_dump($app);
// exit;
?>
  <div class="l-title">
    <h2 class="c-title">記録編集</h2>
  </div>

  <div class="l-main l-inner">
    <form action="log_edit_done.php" method="post" id="editdata" class="p-log-edit" enctype="multipart/form-data">
      <div class="p-login__form">
            <label>活動内容</label>
            <input type="text" name="action" value="<?= isset($app->getValues()->action) ? h($app->getValues()->action): ''; ?>" id="p-login__form-control">
            <p class="err"></p>
      </div>
      <div class="p-login__form">
            <label>活動時間</label>
            <input type="text" name="time" value="<?= isset($app->getValues()->time) ? h($app->getValues()->time): ''; ?>" id="p-login__form-control">
            <p class="err"></p>
      </div>
    </form>
    <div class="p-log-edit__btn">
      <button class="c-btn" onclick="document.getElementById('editdata').submit();">更新</button>
      <input type="hidden" name="token" value="<?= h($_SESSION['token']); ?>">
      <input type="hidden" name="logedit" value="<?= h($_POST['logedit']);?>">
      <p class="err"></p>
    </div>

    <div class="l-pagination">

    </div>
  </div>
  <?php
require_once(__DIR__ .'/footer.php');
?>