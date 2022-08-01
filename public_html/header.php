<?php
require_once(__DIR__ .'/../config/config.php');
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>活動記録アプリ</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Kaisei+Opti:wght@400;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="./css/style.css">
  <script src="./js/script.js"></script>
</head>

<body class="l-inner">
  <header class="l-header l-inner">
    <!-- if文で、ログインしてなかったらログイン画面表示/ログインしていたら活動記録画面-->
    <?php if(isset($_SESSION['me'])) { ?>
    <!-- ログインしているときのヘッダー -->
    <div class="l-header__nav l-header__nav--active">
      <div class="l-header__left">
        <a href="<?= SITE_URL; ?>/">活動記録</a>
        <a href="<?= SITE_URL; ?>/log_archive.php">活動記録一覧</a>
      </div>
      <?php
      if(isset($_SESSION['me'])) { ?>
      <div class="l-header__right" data-me="<?= h($_SESSION['me']->id); ?>">
        <a href="<?= SITE_URL; ?>/mypage.php">
        <span class="l-header__right-name"><?= h($_SESSION['me']->username); ?></span>
        </a>
        <form action="logout.php" method="post" id="logout" class="l-header__right-logout">
        <input type="submit" value="ログアウト">
        <input type="hidden" name="token" value="<?= h($_SESSION['token']); ?>">
        </form>
      </div>
      <?php  } ?>
      </div>
    </div>
    <div class="l-header__spnav">
      <!-- アイコンを追加 -->
        <a href="<?= SITE_URL; ?>/" class="l-header__spnav-img"><img src="./img/icon1.png" alt="活動記録"></a>
        <a href="<?= SITE_URL; ?>/log_archive.php" class="l-header__spnav-img"><img src="./img/icon2.png" alt="活動記録一覧"></a>
        <a href="<?= SITE_URL; ?>/mypage.php" class="l-header__spnav-img"><img src="./img/icon3.png" alt="マイページ"></a>
        <form action="logout.php" method="post" class="c-submit">
          <img src="./img/icon5.png" alt="">
          <input type="submit" value="" class="c-submit__btn">
        <input type="hidden" name="token" value="<?= h($_SESSION['token']); ?>">
        </form>
    </div>
    <?php }else{ ?>
    <!-- ログインしていない時のヘッダー -->
    <div class="l-header__nav l-header__nav--noactive">
      <a href="<?= SITE_URL; ?>/login.php">ログイン</a>
      <a href="<?= SITE_URL; ?>/singup.php">ユーザー登録</a>
    </div>
    <?php } ?>
  </header>

  