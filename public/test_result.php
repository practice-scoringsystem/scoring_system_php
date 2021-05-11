<?php
  require_once "../classes/Questions.php";
  require_once "../classes/CorrectAnswers.php";
  require_once "../classes/UserLogic.php";

  $questions_id = $_POST['id'];
  $inp_answer = $_POST['input_answers'];
  
  for($i = 0; $i < count($questions_id); $i++) {
   $q_id = $questions_id[$i];
   $ca = new CorrectAnswers();
  $db_data = $ca->getAnsByQuestionsId($q_id[$i]);
  }

  $result = 0;

  foreach($inp_answer as $inp_a) {
    if ($inp_a === $db_data) {
      $result += 1;
    }
  }

  var_dump($result);
  die();

?>