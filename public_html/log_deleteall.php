<?php
require_once(__DIR__ .'/header.php');
$logMod = new Bbs\Controller\Log();
// var_dump('a');
// exit;
var_dump($logMod);
exit;
$logMod->logDeleteAll();
?>
