<?php

namespace Bbs\Controller;

class LogDelete extends \Bbs\Controller{
  public function run($log_id){
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
      $log=new \Bbs\Model\Log();
      $log->logDelete($log_id);
      return header('Location: ' . SITE_URL .'/log_archive.php');
      exit();
    }
  }
}