<?php
  ini_set("display_errors", 1);
  error_reporting(E_ALL);

  require_once "../classes/Questions.php";
  require_once "../classes/CorrectAnswers.php";

  $questions = $_POST;

  $question = new Questions();
  $question->questionCreate($questions);

  $answers = $_POST['answers'];
  $answer = new CorrectAnswers();
  $answer->answerCreate($answers);

?>