<?php
  ini_set("display_errors", 1);
  error_reporting(E_ALL);

  require_once "../classes/Questions.php";
  require_once "../classes/CorrectAnswers.php";

  $question = new Questions();
  $questionsData = $question->getAll();

  $CA = new CorrectAnswers();
  $CAData = $CA->getAll();

  function h($s) {
    return htmlspecialchars($s, ENT_QUOTES, "UTF-8");
  }

?>

<!DOCTYPE html>
<html lang="ja">
  <head?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>問題・答え一覧</title>
  </head>
  <body>
    <h2>問題・答え一覧</h2>
    <a href="./Top.php">Top</a>
    <form action="logout.php" method="POST">
      <input type="submit" name="logout" value="ログアウト">
    </form>
    <p><a href="./register_form.php">新規作成</a></p>
    <table>
      <tr>
        <th>id</th>
        <th>問題</th>
        <th>答え１</th>
        <th>答え２</th>
      </tr>
      <?php foreach($questionsData as $column): ?>
        <tr>
          <td><?php echo h($column['id']) ?></td>
          <td><?php echo h($column['question']) ?></td>
          <?php foreach($CAData as $ca_column): ?>
            <td>
              <?php if($ca_column['questions_id'] == $column['id'])
                echo h($ca_column['answer']) ?>
            </td>
          <?php endforeach; ?>
          <td><a href="./update_form.php?id=<?php echo $column['id'] ?>">編集</a></td>
          <td><a href="./delete_confirm.php?id=<?php echo $column['id'] ?>">削除</a></td>
        </tr>
      <?php endforeach; ?>
    </table>
  </body>
</html>