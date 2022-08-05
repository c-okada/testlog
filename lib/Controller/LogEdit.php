<?php
namespace Bbs\Controller;
class LogEdit extends \Bbs\Controller{
  public function run($log_id){
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
      $log=new \Bbs\Model\Log();
      $logData = $log->getLog($log_id);
      // var_dump($logData->action);
      // exit;
      $this->setValues('action',$logData->action);
      $this->setValues('time',$logData->time);
      // $this->setValues('action',$logData['action']);
      // $this->setValues('time',$logData['time']);
    }
  }

  public function logUpdate($editdata){
    // var_dump($editdata);
    // exit;
    $log=new \Bbs\Model\Log();
    $log->logUpdate($editdata);
  }
}