<?php
  ini_set("display_errors", 1);
  error_reporting(E_ALL);

  require_once('../classes/Questions.php');
  require_once('../classes/CorrectAnswers.php');

  $questions = new Questions();
  $result = $questions->getById($_GET['id']);

  $id = $result['id'];
  $question = $result['question'];

  $CA = new CorrectAnswers();
  $CAData = $CA->getAnsById($_GET['id']);

?>

<!DOCTYPE html>
<html lang="ja">
  <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta http-equiv="X-UA-Compatible" content="ie=edge">
      <title>削除確認画面</title>
  </head>
  <body>
    <h2>削除確認画面</h2>
    <form action="delete.php" method="POST">
        <input type="text" name="id" value="<?php echo $id ?>">
        <p>問題：</p>
        <input type="text" name="question" value="<?php echo $question ?>">

        <?php foreach($CAData as $ca_column): ?>
          <tr>
            <p>答え：</p>
            <td><input type="text" name="answers[answers][]" value="<?php echo($ca_column)['answer'] ?>"></td>
            <input type="hidden" name="answers[answer_ids][]" value="<?php echo($ca_column)['id'] ?>">
          </tr>
        <?php endforeach; ?>
        <p>
          <input type="submit" value="削除する">
        </p>
    </form>
  </body>
</html>