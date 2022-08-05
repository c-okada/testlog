<?php
require_once(__DIR__ .'/header.php');
$logMod = new Bbs\Model\Log();
$logs = $logMod->getLogAll();
$calc = $logMod->calcLog();
// $logDelete = $logMod->logDeleteAll();
?>
  <div class="l-title">
    <h2 class="c-title">記録一覧</h2>
  </div>

  <?php foreach($calc as $velue): ?>
    <div class="p-total">
      <p>total<br><span><?= round(h($velue->calctime)) ?></span>分</p>
      <div class="p-total__bg circle-1"></div>
      <div class="p-total__bg circle-2"></div>
      <div class="p-total__bg circle-3"></div>
    </div>
  <?php endforeach; ?>

  <div class="l-main l-inner">
  <?php foreach($logs as $log): ?>
    <div class="p-archive">
      <div class="p-archive__tag">
        <!-- <p><?= h($log->created); ?></p> -->
        <img src="./img/tag-work.png" alt="">
      </div>
      <div class="p-archive__action">
        <p><?= h($log->action); ?></p>
      </div>
      <div class="p-archive__time">
        <p><?= h($log->time); ?><span>分</span></p>
      </div>
      <div class="p-archive__edit">
        <form action="log_edit.php" method="post" class="p-archive__edit-img">
          <input type="hidden" name="logedit" value="<?= h($log->id);?>">
          <input type="image" name="submit" src="./img/icon1.png" alt=" 送信">
        </form>
        <form action="log_delete.php" method="post" class="p-archive__edit-img">
          <input type="hidden" name="logdelete" value="<?= h($log->id);?>">
          <input type="image" name="submit" src="./img/icon6.png" alt=" 送信">
        </form>
      </div>
    </div>
  <?php endforeach; ?>

    <div class="p-alldelete">

    </div>
  </div>
  <?php
require_once(__DIR__ .'/footer.php');
?>