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
  <link rel="stylesheet" href="./css/styles.css">
  <script src="./js/script.js"></script>
</head>

<body class="l-inner">
  <header class="l-header">
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
    <?php }else{ ?>
    <!-- ログインしていない時のヘッダー -->
    <div class="l-header__nav l-header__nav--noactive">
      <a href="<?= SITE_URL; ?>/login.php">ログイン</a>
      <a href="<?= SITE_URL; ?>/singup.php">ユーザー登録</a>
    </div>
    <?php } ?>
  </header>

  