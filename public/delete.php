<?php
  require_once "../classes/Questions.php";
  require_once "../classes/CorrectAnswers.php";

  $questions = $_POST['id'];
  $question = new Questions();
  $result = $question->delete($questions);

  $answers = $_POST['answers'];
  var_dump($answers);
  $answer = new CorrectAnswers();
  $result = $answer->ansDelete($answers);

?>

<p><a href="./list.php">戻る</a></p>