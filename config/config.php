<?php
// ini_set('display_errors',1);//本番移行時削除
define('DSN','mysql:host=mysql1.php.xdomain.ne.jp;charset=utf8;dbname=testlog');
define('DB_USERNAME','user');
define('DB_PASSWORD','user1111');
define('SITE_URL', 'http://' . $_SERVER['HTTP_HOST'] . '/testlog/public_html');
require_once(__DIR__ .'/../lib/Controller/functions.php');
require_once(__DIR__ . '/autoload.php');
session_start();

//非ログイン時のリダイレクト処理
$current_uri = $_SERVER["REQUEST_URI"];
$file_name = basename($current_uri);
if(strpos($file_name,'login.php') !== false || strpos($file_name,'signup.php') !== false || strpos($file_name,'index.php') !== false || strpos($file_name,'public_html') !== false){
  //URL内のファイル名がlogin.php,signup.php,index.php(public_html)のとき
}else{
  //それ以外の時
  // if(!isset($_SESSION['me'])){
  //   header('Location: ' . SITE_URL . '/login.php');
  //   exit();
  // }
}