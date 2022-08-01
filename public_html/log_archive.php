<?php
require_once(__DIR__ .'/header.php');
$logMod = new Bbs\Model\Log();
$logs = $logMod->getLogAll();
?>
  <div class="l-title">
    <h2 class="c-title">記録一覧</h2>
  </div>

  <div class="l-main l-inner">
    <div class="l-total">
      <p class="c-month"><span>月</span></p>
      <p class="c-time"><span>時間</span></p>
    </div>
    <?php foreach($logs as $log): ?>

    <div class="l-table">
    <?= h($log->action); ?>

    </div>
    <?php endforeach; ?>

    <div class="l-pagination">

    </div>
  </div>
  <?php
require_once(__DIR__ .'/footer.php');
?>