<?php
require_once(__DIR__ .'/header.php');
?>

  <div class="l-title">
    <h2 class="c-title">検針記録</h2>
  </div>

  <form action="" method="post" id="log" class="form">
    <div class="l-log">
      <button class="btn c-btn c-btn__start">開始</button>
      <input type="hidden" name="">
      <button class="btn c-btn c-btn__fin">終了</button>
      <input type="hidden" name="">
    </div>

    <div class="l-count">
      <input type="text" class="c-count"><span class="c-value">/件</span>
    </div>

    <div class="l-remarks">
      <p class="c-item">備忘録：</p>
      <p class="c-remark"></p>
    </div>

    <div class="l-score">
      <input type="submit" class="btn c-btn c-btn__score">記録する</input>
    </div>
  </form>
  <?php
  require_once(__DIR__ .'/footer.php');
  ?>