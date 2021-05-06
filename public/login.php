<?php
session_start();

require_once '../classes/UserLogic.php';

$err = [];

if(!$email = filter_input(INPUT_POST, 'id')) {
  $err['id'] = 'idを記入してください。';
}
if(!$password = filter_input(INPUT_POST, 'password')) {
  $err['password'] = 'パスワードを記入してください。';
}

if (count($err) > 0) {
  $_SESSION = $err;
  header('Location: login.php');
  return;
}

$result = UserLogic::login($email, $password);

if (!$result) {
  header('Location: login_form.php');
  return;
}

?>
<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Topページ</title>
  </head>
  <body>
    <form action="logout.php" method="POST">
      <input type="submit" name="logout" value="ログアウト">
    </form>
   
    <a href="./list.php">問題と答えを確認・登録する ></a>
  </body>
</html>