<?php
namespace Bbs\Controller;
class Log extends \Bbs\Controller{
  public function run(){
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
      $this->createLog();
    }
  }

  public function createLog(){
    //バリデーション
    // try{
    //   $this->validate();
    // }catch (\Bbs\Exception\EmptyPost $e){
    //   $this->setErrors('create_thread',$e->getMessage());
    // }catch (\Bbs\Exception\CharLength $e){
    //   $this->setErrors('create_thread',$e->getMessage());
    // }
    //モデルに値を渡すコントローラーを記述する
    $this->setValues('action',$_POST['action']);
    $this->setValues('start',$_POST['start']);
    $this->setValues('finish',$_POST['finish']);
    $this->setValues('time',$_POST['time']);
    // $day = new DateTime();
    // $day -> format('G:i');
    // var_dump($day);
    // exit;

    // $day = date('Y-n-d h:i:s','start')

    if ($this->hasError()){
      return;
    }else{
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

  // private function validate(){
  //   if(!isset($_POST['token']) || $_POST['token'] !== $_SESSION['token']){
  //       echo "不正なトークンです！";
  //     exit();
  //   }
  //   if ($_POST['id'] === 'log') {
  //     if(!isset($_POST['start']) && !isset($_POST['finish'])){
  //       echo '時間を取得してください';
  //     exit();
  //     }
  //     if(!isset($_POST['start'])){
  //       echo '時間を取得してください';
  //     }
  //     if(!isset($_POST['finish'])){
  //       echo '時間を取得してください';
  //     }
  //     if(mb_strlen($_POST['action']) > 200){
  //       throw new \Bbs\Exception\CharLength("コメントが長すぎます！");
  //     }
  //   }

  //   //課題：コメントバリデーション
  //   if ($_POST['type'] === 'createcomment') {
  //     if(!isset($_POST['content'])){
  //       echo '不正な投稿です';
  //     exit();
  //     }
  //     if($_POST['content'] === ''){
  //       throw new \Bbs\Exception\EmptyPost("コメントが入力されていません！");
  //     }
  //     if(mb_strlen($_POST['content']) > 200){
  //       throw new \Bbs\Exception\CharLength("コメントが長すぎます！");
  //     }
  //   }
  // }
}