<?php
namespace Bbs\Controller;
class LogEdit extends \Bbs\Controller{
  public function run($log_id){
    $log=new \Bbs\Model\Log();
    $logData = $log->getLog($log_id);
  if($_SERVER['REQUEST_METHOD'] === 'POST'){
      // var_dump($logData);
      // exit;
      $this->setValues('action',$logData->action);
      $this->setValues('time',$logData->time);
      // $this->setValues('action',$logData['action']);
      // $this->setValues('time',$logData['time']);
      $this->logUpdate($logData);
    }
  }

  public function logUpdate($logData){
    // var_dump($logData);
    // exit;
    try{
      $this->validate($logData);
    }catch (\Bbs\Exception\EmptyTime $e){
      // var_dump('ok');
      // exit;
      $this->setErrors('time',$e->getMessage());
    }catch (\Bbs\Exception\Digit $e){
      $this->setErrors('time',$e->getMessage());
    }catch (\Bbs\Exception\EmptyPost $e){
      $this->setErrors('action',$e->getMessage());
    }catch (\Bbs\Exception\CharLength $e){
      $this->setErrors('action',$e->getMessage());
    }
    // var_dump($editdata);
    // exit;
    // var_dump($this->hasError());
    // exit;

    if ($this->hasError()){
      return;
    }
    if(!isset($_POST['time']))
    {
      return;
    }else{
      $log=new \Bbs\Model\Log();
      $logData = $log->logUpdate();
    // var_dump($logData);
    // exit;
      header('Location: '. SITE_URL . '/log_archive.php');
      exit();
    }
  }

  private function validate($logData){
    if(!isset($_POST['token']) || $_POST['token'] !== $_SESSION['token']){
        echo "不正なトークンです！";
      exit();
    }
    if(isset($_POST['time'])){
      if($_POST['time'] === "" &&  $_POST['action'] === ""){
        throw new \Bbs\Exception\EmptyTime("全て入力してください！");
      exit();
      }
      if($_POST['time'] === ""){
        throw new \Bbs\Exception\EmptyTime("時間を入力してください！");
      }
      if(!is_numeric($_POST['time'])){
        throw new \Bbs\Exception\Digit("半角数字で入力してください！");
      }
      if($_POST['action'] === ""){
        throw new \Bbs\Exception\EmptyPost("内容を入力してください！");
      }
      if(mb_strlen($_POST['action']) > 200){
        throw new \Bbs\Exception\CharLength("記録が長すぎます！");
      }
    }
  }

}