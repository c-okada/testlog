<?php
require_once(__DIR__ .'/header.php');

$app = new Bbs\Controller\Log();
$app->run();
?>

<div class="l-title l-inner">
    <h2 class="c-title">活動記録</h2>
  </div>

  <form action="" method="post" id="log" class="l-main l-inner">
    <div class="p-log">
      <input type="button" value="開始" class="c-time">
      <input type="button" value="終了" class="c-time">
    </div>
    <p class="err"></p>
    <div class="p-action">
      <P class="p-action__value">活動内容：</p>
      <textarea name="action" class="c-action"></textarea>
    </div>
    <p class="err"></p>

    <div class="p-score">
      <input type="submit" value="記録する" class="c-btn">
      <input type="hidden" name="token" value="<?= h($_SESSION['token']); ?>">
    </div>
    <p class="err"><?= h($app->getErrors('create_thread')); ?></p>
  </form>

  <script src="./js/timer.js"></script>

  <?php
  require_once(__DIR__ .'/footer.php');
  ?>