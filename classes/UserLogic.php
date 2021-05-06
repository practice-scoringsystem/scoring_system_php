<?php
require_once '../dbconnect.php';

class UserLogic {

   /**
   * ログイン処理
   * @param string $email
   * @param string $password
   * @return bool $result
   */
  public static function login($id, $password) {
    $result = false;

    $user = self::getUserById($id);

    if (!$user) {
      $_SESSION['msg'] = 'idが一致しません。';
      return $result;
    }

    if(password_verify($password, $user['password'])) {
      session_regenerate_id(true);
      $_SESSION['login_user'] = $user;
      $result = true;
      return $result;
    }
      $_SESSION['msg'] = 'パスワードが一致しません。';
      return $result;
  }
  /**
   * emailからユーザーを取得
   * @param string $email
   * @return array|bool $user|false
   */
  public static function getUserById($id) {
    $sql = 'SELECT * FROM users WHERE id = ?';
    
    $arr = [];
    $arr[] = $id;

    try {
      $stmt = connect()->prepare($sql);
      $stmt->execute($arr);
      $user = $stmt->fetch();
      return $user;
    } catch(\Exception $e) {
      return $false;
    }
  }

  /**
   * ログインチェック
   * @param void
   * @return bool $result
   */
  public static function checkLogin() {
    $result = false;

    if (isset($_SESSION['login_user']) && $_SESSION['login_user']['id'] > 0) {
      return $result = true;
    }
  }

  /**
   * ログアウト処理
   */
  public static function logout() {
    $_SESSION = array();
    session_destroy();
  }
}
?>