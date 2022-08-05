<?php
require_once(__DIR__ .'/header.php');
$app=new Bbs\Controller\LogDelete();
$app->run($_POST['logdelete']);
?>
