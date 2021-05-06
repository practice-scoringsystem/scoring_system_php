<?php
  session_start();

  require_once "../classes/UserLogic.php";

  $result = UserLogic::checkLogin();
  if($result) {
    header('Location: list.php');
    return;
  }
  
  $err = $_SESSION;

  $_SESSION = array();
  session_destroy();
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ログイン画面</title>
</head>
<body>
<h2>ログインフォーム</h2>
  <?php if (isset($err['msg'])) : ?>
    <p><?php echo $err['msg']; ?></p>
  <?php endif; ?>
  <form action="login.php" method="POST">
    <p>
      <label for="id">id：</label>
      <input type="text" name="id">
      <?php if (isset($err['id'])) : ?>
        <p><?php echo $err['id']; ?></p>
      <?php endif; ?>
    </p>
    <p>
      <label for="password">パスワード：</label>
      <input type="password" name="password">
      <?php if (isset($err['password'])) : ?>
        <p><?php echo $err['password']; ?></p>
      <?php endif; ?>
    </p>
    <p>
      <input type="submit" value="ログイン">
    </p>
  </form>
</body>
</html>