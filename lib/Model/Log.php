<?php
namespace Bbs\Model;
class Log extends \Bbs\Model {
  public function createLog($values){
    try{
      $this->db->beginTransaction();
      $sql = "INSERT INTO log (user_id,action,created,modified) VALUES (:user_id,:action,now(),now())";
      $stmt = $this->db->prepare($sql);
      $stmt->bindValue('user_id',$values['user_id']);
      $stmt->bindValue('action',$values['action']);
      $res = $stmt->execute();
      $log_id = $this->db->lastInsertId();
      $sql = "INSERT INTO timer (user_id,log_id,start,finish,time) VALUES (:user_id,:log_id,:start,:finish,:time)";
      $stmt = $this->db->prepare($sql);
      $stmt->bindValue('log_id',$log_id);
      $stmt->bindValue('user_id',$values['user_id']);
      $stmt->bindValue('start',$values['start']);
      $stmt->bindValue('finish',$values['finish']);
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
  // public function getLogAll(){
  //   $user_id = $_SESSION['me']->id;
  //   $stmt = $this->db->query("SELECT l.id AS l_id,action,u.id AS u_id,t.id AS t_id,l.created FROM log AS l LEFT JOIN timer AS t ON l.delflag = 0 AND t.id = f.timer_id  AND u.user_id = $user_id ORDER BY l.id desc");
  //   return $stmt->fetchAll(\PDO::FETCH_OBJ);
  // }

}