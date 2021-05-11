<?php
  // session_start();
  require_once "../classes/Questions.php";
  require_once "../classes/CorrectAnswers.php";
  require_once "./common/htmlspecialchars.php";
  require_once "../classes/UserLogic.php";

  // $login_user = $_SESSION['login_user'];

  $question = new Questions();
  $questionsData = $question->getRndAll();

?>

<!DOCTYPE html>
<html lang="ja">
  <head?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>テスト画面</title>
  </head>
  <body>
    <h2>テスト画面</h2>
    <?php include("./common/header.php"); ?>
    <table>
      <form action="test_result.php" method="POST">
        <?php foreach($questionsData as $column): ?>
          <tr>  
            <td>id:<?php echo h($column['id']) ?></td>
            <td><input type="hidden" name="ids[]" value="<?php echo h($column['id']) ?>"></td>
            
            <td>問題:<?php echo h($column['question']) ?></td>
            
            <td><input type="text" name="input_answers[]"></td>
          </tr>
        <?php endforeach; ?>
        <input type="hidden" name="user_id" value="<?php echo h($login_user['id']) ?>"><br>
        <td><input type="submit" value="採点する"></td>
      </form>
    </table>
  </body>
</html>