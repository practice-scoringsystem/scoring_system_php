<?php

  require_once('../classes/Questions.php');
  require_once('../classes/CorrectAnswers.php');

  $questions = new Questions();
  $result = $questions->getById($_GET['id']);

  $id = $result['id'];
  $question = $result['question'];

  $CA = new CorrectAnswers();
  $CAData = $CA->getAnsById($_GET['id']);

  $error = array();

?>

<!DOCTYPE html>
<html lang="ja">
  <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta http-equiv="X-UA-Compatible" content="ie=edge">
      <title>編集画面</title>
  </head>
  <body>
    <?php include("./common/header.php"); ?>
    <h2>編集画面</h2>
    <form action="update_confirm.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $id ?>">
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
          <input type="submit" value="送信">
        </p>

    </form>
  </body>
</html>