<?php
require_once(__DIR__ .'/header.php');
?>

  <div class="l-title">
    <h2 class="c-title">検針記録</h2>
  </div>

  <div class="l-log">
    <button class="c-btn c-btn__start">開始</button>
    <button class="c-btn c-btn__fin">終了</button>
  </div>

  <div class="l-count">
    <p class="c-count"></p>
    <p class="c-value">件</p>
  </div>

  <div class="l-remarks">
    <p class="c-item">備忘録：</p>
    <p class="c-remark"></p>
  </div>

  <div class="l-score">
    <button class="c-btn c-btn__score">記録する</button>
  </div>
  <?php
  require_once(__DIR__ .'/footer.php');
  ?>