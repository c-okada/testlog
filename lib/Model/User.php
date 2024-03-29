<?php
namespace Bbs\Model;
class User extends \Bbs\Model {
  public function create($values) {
    $stmt = $this->db->prepare("INSERT INTO users (username,email,password,created,modified) VALUES (:username,:email,:password,now(),now())");
    $res = $stmt->execute([
      ':username' => $values['username'],
      ':email' => $values['email'],
      // パスワードのハッシュ化
      ':password' => password_hash($values['password'],PASSWORD_DEFAULT)
    ]);
    // var_dump($stmt);
    // exit;

    // var_dump($res);
    // exit;
    // メールアドレスがユニークでなければfalseを返す
    if ($res === false) {
      throw new \Bbs\Exception\DuplicateEmail();
    }
  }

  public function login($values) {
    $stmt = $this->db->prepare("SELECT * FROM users WHERE email = :email;");
    $stmt->execute([
      ':email' => $values['email']
    ]);
    $stmt->setFetchMode(\PDO::FETCH_CLASS, 'stdClass');
    $user = $stmt->fetch();
    if (empty($user)) {
      throw new \Bbs\Exception\UnmatchEmailOrPassword();
    }
    if (!password_verify($values['password'], $user->password)) {
      throw new \Bbs\Exception\UnmatchEmailOrPassword();
    }
    //退会済みか調べる
    if($user->delflag == 1){
      throw new \Bbs\Exception\DeleteUser();
    }
    return $user;
  }

  public function find($id){
    $stmt = $this->db->prepare("SELECT * FROM users WHERE id = :id;");
    $stmt->bindValue('id',$id);
    $stmt->execute();
    $stmt->setFetchMode(\PDO::FETCH_CLASS,'stdClass');
    $user = $stmt->fetch();
    return $user;
  }

  public function update($values){
    $stmt = $this->db->prepare("UPDATE users SET username = :username,email = :email,image = :image,modified = now() where id = :id");
    $stmt->execute([
      ':username' => $values['username'],
        ':email' => $values['email'],
        'image' => $values['userimg'],
        ':id' => $_SESSION['me']->id,
    ]);
    if($res === false){
      throw new \Bbs\Exception\DuplicateEmail();
    }
  }

  public function delete(){
    $stmt = $this->db->prepare("UPDATE users SET delflag = :delflag,modified = now() where id = :id");
    $stmt->execute([
      ':delflag' => 1,
      ':id' => $_SESSION['me']->id,
    ]);
  }
}