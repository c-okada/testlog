<?php
namespace Bbs\Controller;
class Login extends \Bbs\Controller {
  public function run() {
    // ログインしていればトップページへ移動
    if ($this->isLoggedIn()) {
      header('Location: ' . SITE_URL);
      exit();
    }
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $this->postProcess();
    }
  }
  //
  protected function postProcess() {
    //バリデーションを実行する
    try {
      $this->validate();
      //バリデーションエラーが起きたら、当てはまったバリデーションのエラーメッセージを処理する
    } catch (\Bbs\Exception\EmptyPost $e) {
        $this->setErrors('login', $e->getMessage());
    }
    //emailの値を格納する
    $this->setValues('email', $_POST['email']);
    //エラーなら処理を戻る
    if ($this->hasError()) {
      return;
    //emailに問題がなければ、emailとpasswordを処理する
    } else {
      try {
        $userModel = new \Bbs\Model\User();
        $user = $userModel->login([
          'email' => $_POST['email'],
          'password' => $_POST['password']
        ]);
      }
      catch (\Bbs\Exception\UnmatchEmailOrPassword $e) {
        $this->setErrors('login', $e->getMessage());
        return;
      }
      catch (\Bbs\Exception\DeleteUser $e) {
        $this->setErrors('login', $e->getMessage());
        return;
      }
      // ログイン処理
      //session_regenerate_id関数･･･現在のセッションIDを新しいものと置き換える。セッションハイジャック対策
      session_regenerate_id(true);
      // ユーザー情報をセッションに格納
      $_SESSION['me'] = $user;
      // スレッド一覧ページへリダイレクト
      header('Location: '. SITE_URL . '/');
      exit();
    }
  }
  
  //フォーム欄のバリデーション
  private function validate() {
    // トークンが空またはPOST送信とセッションに格納された値が異なるとエラー
    if (!isset($_POST['token']) || $_POST['token'] !== $_SESSION['token']) {
      echo "トークンが不正です!";
      exit();
    }
    // emailとpasswordのキーがなかった場合、強制終了
    if (!isset($_POST['email']) || !isset($_POST['password'])) {
      echo "不正なフォームから登録されています!";
      exit();
    }
    // emailとpasswordの欄が空白だったらエラーメッセージ
    if ($_POST['email'] === '' || $_POST['password'] === '') {
      throw new \Bbs\Exception\EmptyPost("メールアドレスとパスワードを入力してください!");
    }
  }
}