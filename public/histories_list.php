<?php
  session_start();

  require_once "../classes/Histories.php";
  require_once "../classes/UserLogic.php";

  // ログインチェック
  $result = UserLogic::checkLogin();

  if (!$result) {
    $_SESSION['login_err'] = 'ログインしてください。';
    header('Location: login_form.php');
    return;
  }

  // ログインユーザー情報
  $login_user = $_SESSION['login_user'];
  $user_id = $login_user['id'];
  $user_name = $login_user['name'];

  $history = new Histories();
  $histories = $history->getHistoryByUserId($user_id);

?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>採点結果履歴画面</title>
</head>
<body>
  <?php include("./common/header.php"); ?>
  <h2>履歴</h2>
  <table border="1">
    <tr>
      <th>氏名</th>
      <th>得点</th>
      <th>採点時間</th>
    </tr>
    <?php foreach($histories as $his_column) {?>
      <tr>
        <td><?php echo($user_name); ?></td>
        <td><?php echo($his_column['point']) ?>点</td>
        <td><?php echo($his_column['created_at']) ?></td>
      </tr>
    <?php } ?>
  </table>
</body>
</html>