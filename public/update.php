<?php
  require_once "../classes/Questions.php";
  require_once "../classes/CorrectAnswers.php";

  $questions = $_POST;
  $question = new Questions();
  $question->questionUpdate($questions);

  $answers = $_POST['answers'];
  $answer = new CorrectAnswers();
  $answer->answerUpdate($answers);

  header("location: list.php");

?>