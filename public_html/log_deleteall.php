<?php
require_once(__DIR__ .'/header.php');
// var_dump('a');
// exit;
// var_dump($_POST);
// exit;
// $logMod = new Bbs\Controller\Log();
// $logMod->logDeleteAll();
if($_SERVER['REQUEST_METHOD'] === 'POST'){
  $logModel = new Bbs\Model\Log();
  $logModel->logDeleteAll();
}
header('Location: '. SITE_URL . '/index.php');
exit();
?>
