<?php
require_once(__DIR__ .'/header.php');
$app=new Bbs\Controller\LogEdit();
// var_dump('a');
// exit;
$app->logUpdate($_POST);
?>
