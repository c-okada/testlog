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
    // var_dump($_POST);
    // exit;
    try{
      $this->validate();
    }catch (\Bbs\Exception\EmptyTime $e){
      $this->setErrors('time',$e->getMessage());
    }catch (\Bbs\Exception\Digit $e){
      $this->setErrors('time',$e->getMessage());
    }catch (\Bbs\Exception\EmptyPost $e){
      // var_dump('ok');
      // exit;
      $this->setErrors('action',$e->getMessage());
    }catch (\Bbs\Exception\CharLength $e){
      $this->setErrors('action',$e->getMessage());
    }
    // var_dump($editdata);
    // exit;
    if ($this->hasError()){
      // var_dump('a');
      // exit;
      return header('Location: ' . SITE_URL .'/log_edit.php');
    }else{
    $log=new \Bbs\Model\Log();
    $log->logUpdate($editdata);
    }
    return header('Location: ' . SITE_URL .'/log_archive.php');
    exit();
  }

  private function validate(){
    // var_dump($_POST);
    // exit;
    if(!isset($_POST['token']) || $_POST['token'] !== $_SESSION['token']){
        echo "不正なトークンです！";
      exit();
    }
    if(!isset($_POST['time']) &&  $_POST['action'] === ""){
      throw new \Bbs\Exception\EmptyTime("全て入力してください！");
    // exit();
    }
    if(!isset($_POST['time'])){
      throw new \Bbs\Exception\EmptyTime("時間を取得してください！");
    }
    if(is_int($_POST['time'])){
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