<?php
namespace Bbs\Model;
class Log extends \Bbs\Model {
  public function createLog($values){
      // var_dump($values);
      // exit;
      try{
      // タイマーテーブル削除
      // $this->db->beginTransaction();
      // $sql = "INSERT INTO timer (start,finish) VALUES (:start,:finish)";
      // $stmt = $this->db->prepare($sql);
      // $stmt->bindValue('start',$values['start']);
      // $stmt->bindValue('finish',$values['finish']);
      // $stmt->execute();
      // $timer_id = $this->db->lastInsertId();
      // $sql = "INSERT INTO log (user_id,timer_id,action,time,created,modified) VALUES (:user_id,:timer_id,:action,:time,now(),now())";
      // $stmt = $this->db->prepare($sql);
      // $stmt->bindValue('user_id',$values['user_id']);
      // $stmt->bindValue('timer_id',$timer_id);
      // $stmt->bindValue('action',$values['action']);
      // $stmt->bindValue('time',['time']);
      // $stmt->execute();
      // $this->db->commit();
      // var_dump($stmt->errorInfo());
      // exit;
      $this->db->beginTransaction();
      $sql = "INSERT INTO log (user_id,action,time,created,modified) VALUES (:user_id,:action,:time,now(),now())";
      $stmt = $this->db->prepare($sql);
      $stmt->bindValue('user_id',$values['user_id']);
      $stmt->bindValue('action',$values['action']);
      $stmt->bindValue('time',$values['time']);
      $stmt->execute();
      $this->db->commit();
    }catch(\Exception $e){
      echo $e->getMessage();
      $this->db->rollBack();
    }
  }

  // 全ログ取得
  public function getLogAll(){
    $sql = "SELECT * FROM log WHERE user_id = :user_id AND delflag = :delflag";
    $stmt = $this->db->prepare($sql);
    $stmt->bindValue('user_id',$_SESSION['me']->id);
    $stmt->bindValue('delflag', 0);
    $stmt->execute();
    return $stmt->fetchAll(\PDO::FETCH_OBJ);
  }

  // 全スレッド時間合計
  public function calcLog(){
    $sql = "SELECT sum(time) AS calctime FROM log WHERE user_id = :user_id AND delflag = :delflag";
    $stmt = $this->db->prepare($sql);
    $stmt->bindValue('user_id',$_SESSION['me']->id);
    $stmt->bindValue('delflag', 0);
    $stmt->execute();
    return $stmt->fetchAll(\PDO::FETCH_OBJ);
  }

  //ログ編集
  public function logUpdate(){
    $sql = "UPDATE log SET action = :action,time = :time where id = :id";
    $stmt = $this->db->prepare($sql);
    $stmt->bindValue('action',$_POST['action']);
    $stmt->bindValue('time',$_POST['time']);
    $stmt->bindValue('id',$_POST['id']);
    $stmt->execute();
    // var_dump($stmt);
    // exit;
    return $stmt->fetchAll(\PDO::FETCH_OBJ);
    // var_dump($stmt->errorInfo());
    // exit;
  }

  
  // 編集ログ取得
  public function getLog($log_id){
    $sql = "SELECT * FROM log WHERE user_id = :user_id AND delflag = :delflag AND id = :id";
    $stmt = $this->db->prepare($sql);
    $stmt->bindValue('user_id',$_SESSION['me']->id);
    $stmt->bindValue('delflag', 0);
    $stmt->bindValue('id',$log_id);
    $stmt->execute();
    // var_dump($stmt->errorInfo());
    // exit;
    $stmt->setFetchMode(\PDO::FETCH_CLASS,'stdClass');
    return $stmt->fetch();
  }

  //ログ削除
  public function logDelete($log_id){
    // var_dump($value);
    // exit;
    $sql = "UPDATE log SET delflag = :delflag,modified = now() where id = :id";
    $stmt = $this->db->prepare($sql);
    $stmt->bindValue('delflag', 1);
    $stmt->bindValue('id',$log_id);
    $stmt->execute();
    // var_dump($stmt->errorInfo());
    // exit;
  }

  // 全ログ削除
  public function logDeleteAll(){
    $sql = "UPDATE log SET delflag = :delflag,modified = now() WHERE user_id = :user_id";
    $stmt = $this->db->prepare($sql);
    $stmt->bindValue('user_id',$_SESSION['me']->id);
    $stmt->bindValue('delflag', 1);
    $stmt->execute();
    return $stmt->fetchAll(\PDO::FETCH_OBJ);
  }

}