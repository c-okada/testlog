<?php
// ini_set('display_errors',1);//本番移行時削除
define('DSN','mysql:host=us-cdbr-east-06.cleardb.net;charset=utf8;dbname=heroku_0f63c1d3acab9ef');
define('DB_USERNAME','b6772c0b87948a');
define('DB_PASSWORD','cde63861');
// define('SITE_URL', 'http://' . $_SERVER['HTTP_HOST'] . '/testlog/public_html');
define('SITE_URL', 'http://' . $_SERVER['HTTP_HOST']);
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