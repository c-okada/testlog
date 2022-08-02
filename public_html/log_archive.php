<?php
require_once(__DIR__ .'/header.php');
$logMod = new Bbs\Model\Log();
$logs = $logMod->getLogAll();
?>
  <div class="l-title">
    <h2 class="c-title">記録一覧</h2>
  </div>

  <div class="l-main l-inner">
  <?php foreach($logs as $log): ?>
    <div class="p-archive">
      <div class="p-archive__tag">
        <img src="./img/tag-work.png" alt="">
      </div>
      <div class="p-archive__action">
        <p><?= h($log->action); ?></p>
      </div>
      <div class="p-archive__time">
        <p><span>分</span></p>
      </div>
      <div class="p-archive__edit">
        <button class="p-archive__edit-img"><img src="./img/icon1.png" alt=""></button>
        <button class="p-archive__edit-img"><img src="./img/icon6.png" alt=""></button>
      </div>
    </div>
  <?php endforeach; ?>
    <!-- <div class="p-archive">
      <div class="p-archive__tag">
        <img src="./img/tag-play.png" alt="">
      </div>
      <div class="p-archive__action">
        <p>活動内容活動内容活動内容活動内容活動内容活動内容活動内容活動内容活動内容活動内容活動内容</p>
      </div>
      <div class="p-archive__time">
        <p><span>分</span></p>
      </div>
      <div class="p-archive__edit">
        <button class="p-archive__edit-img"><img src="./img/icon1.png" alt=""></button>
        <button class="p-archive__edit-img"><img src="./img/icon6.png" alt=""></button>
      </div>
    </div>

    <div class="p-archive">
      <div class="p-archive__tag">
        <img src="./img/tag-study.png" alt="">
      </div>
      <div class="p-archive__action">
        <p>活動内容活動内容活動内容活動内容活動内容活動内容活動内容活動内容活動内容活動内容活動内容</p>
      </div>
      <div class="p-archive__time">
        <p><span>分</span></p>
      </div>
      <div class="p-archive__edit">
        <button class="p-archive__edit-img"><img src="./img/icon1.png" alt=""></button>
        <button class="p-archive__edit-img"><img src="./img/icon6.png" alt=""></button>
      </div>
    </div> -->


    <div class="l-table">

    </div>

    <div class="l-pagination">

    </div>
  </div>
  <?php
require_once(__DIR__ .'/footer.php');
?>