<?php
require_once(__DIR__ .'/header.php');

$app = new Bbs\Controller\Log();
$app->run();
?>

<div class="l-title">
    <h2 class="c-title">活動記録</h2>
  </div>

  <form action="" method="post" id="log">
    <div class="l-log">
      <input type="button" value="開始">
      <input type="button" value="終了">
    </div>
    <div class="p-action">
      <P class="p-action__value">活動内容：
      <input type="text" name="action" class="p-action">
    </div>

    <div class="l-score">
      <input type="submit" value="記録する" class="c-btn">
      <input type="hidden" name="token" value="<?= h($_SESSION['token']); ?>">
    </div>
    <p class="err"><?= h($app->getErrors('create_thread')); ?></p>
  </form>

  <?php
  require_once(__DIR__ .'/footer.php');
  ?>