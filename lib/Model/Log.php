<?php
namespace Bbs\Model;
class Log extends \Bbs\Model {
  public function createLog($values){
    try{
      $this->db->beginTransaction();
      $sql = "INSERT INTO timer (user_id,start,finish) VALUES (:user_id,:start,:finish)";
      $stmt = $this->db->prepare($sql);
      $stmt->bindValue('user_id',$values['user_id']);
      $stmt->bindValue('start',$values['start']);
      $stmt->bindValue('finish',$values['finish']);
      $res = $stmt->execute();
      $timer_id = $this->db->lastInsertId();
      $sql = "INSERT INTO log (user_id,timer_id,action,time,created,modified) VALUES (:user_id,:timer_id,:action,:time,now(),now())";
      $stmt = $this->db->prepare($sql);
      $stmt->bindValue('user_id',$values['user_id']);
      $stmt->bindValue('timer_id',$timer_id);
      $stmt->bindValue('action',$values['action']);
      $stmt->bindValue('time',$values['time']);
      $res = $stmt->execute();
      $this->db->commit();
      // var_dump($stmt->errorInfo());
      // exit;
      
    }catch(\Exception $e){
      echo $e->getMessage();
      $this->db->rollBack();
    }
  }

  // 全スレッド取得
  public function getLogAll(){
    $user_id = $_SESSION['me']->id;
    $stmt = $this->db->query("SELECT l.id AS l_id,user_id,action,t.time AS t_time,created FROM log AS l INNER JOIN timer AS t ON l.delflag = 0 AND l_id = t.log_id ORDER BY l.id desc");
    return $stmt->fetchAll(\PDO::FETCH_OBJ);
  }

}