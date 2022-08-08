<?php
namespace Bbs\Controller;
class Log extends \Bbs\Controller{
  public function run(){
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
      $this->createLog();
    }
  }

  public function createLog(){
    try{
      $this->validate();
    }catch (\Bbs\Exception\EmptyTime $e){
      $this->setErrors('time',$e->getMessage());
    }catch (\Bbs\Exception\EmptyPost $e){
      $this->setErrors('action',$e->getMessage());
    }catch (\Bbs\Exception\CharLength $e){
      $this->setErrors('action',$e->getMessage());
    }
    //モデルに値を渡すコントローラーを記述する
    $this->setValues('action',$_POST['action']);
    // $this->setValues('start',$_POST['start']);
    // $this->setValues('finish',$_POST['finish']);
    // $this->setValues('time',$_POST['time']);
    // $day = new DateTime();
    // $day -> format('G:i');
    // var_dump($day);
    // exit;

    // $day = date('Y-n-d h:i:s','start')

    if ($this->hasError()){
      return;
    }else{
      $this->setValues('start',$_POST['start']);
      $this->setValues('finish',$_POST['finish']);
      $this->setValues('time',$_POST['time']);
      $logModel = new \Bbs\Model\Log();
      $logModel->createLog([
        'action' => $_POST['action'],
        // 'start' => $day,
        'start' => $_POST['start'],
        'finish' => $_POST['finish'],
        'time' => $_POST['time'],
        'user_id' => $_SESSION['me']->id
      ]);
      header('Location: '. SITE_URL . '/log_archive.php');
      exit();
    }
  }

  private function validate(){
    if(!isset($_POST['token']) || $_POST['token'] !== $_SESSION['token']){
        echo "不正なトークンです！";
      exit();
    }
    if(!isset($_POST['start']) && !isset($_POST['finish']) && $_POST['action'] === ""){
      throw new \Bbs\Exception\EmptyPost("全て入力してください！");
    exit();
    }
    if(!isset($_POST['start'])){
      throw new \Bbs\Exception\EmptyTime("時間を取得してください！");
    }
    if(isset($_POST['start'])){
      $this->setValues('start',$_POST['start']);
    }
    if(!isset($_POST['finish'])){
      throw new \Bbs\Exception\EmptyTime("時間を取得してください！");
    }
    if(isset($_POST['finish'])){
      // $finish_log = date($_POST['finish'],'H時i分s秒');
      // console($finish_log);
      $this->setValues('finish',$_POST['finish']);
    }
    if($_POST['action'] === ""){
      throw new \Bbs\Exception\EmptyPost("内容を入力してください！");
    }
    if(mb_strlen($_POST['action']) > 200){
      throw new \Bbs\Exception\CharLength("記録が長すぎます！");
    }
  }
}