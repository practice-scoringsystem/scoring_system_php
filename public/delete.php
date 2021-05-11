<?php
  require_once "../classes/Questions.php";
  require_once "../classes/CorrectAnswers.php";

  $id = $_POST['id'];
  $question = new Questions();
  $result = $question->delete($id);

  $answers = $_POST['answers'];
  $answer = new CorrectAnswers();
  $result = $answer->ansDelete($answers);

  header("location: list.php");

?>