<?php
  require_once "../classes/Questions.php";
  require_once "../classes/CorrectAnswers.php";
  require_once "../classes/UserLogic.php";

  $question_ids = $_POST['ids'];
  $inp_answers = $_POST['input_answers'];

  // DBの値を取り出す
  for($i = 0; $i < count($question_ids); $i++) {
    $q_id = (int)$question_ids[$i];
    $ca = new CorrectAnswers();
    $db_data = $ca->getAnsByQuestionsId($q_id);
   
    // 取り出したDBの値から必要な情報だけ取り出す
    $answers = array_column($db_data, 'answer');

    echo "<pre>";
      var_dump($answers);
    echo "<pre>";

    // フォームから入力した値を回す
    for($j = 0; $j < count($inp_answers); $j++) {
      $inp_ans = $inp_answers[$j];

      $score = 0;

      // DBの値を回す
      for($k = 0; $k < count($answers); $k++) {
        $db_ans = $answers[$k];
        
        if ($db_ans === $inp_ans) {

          echo "<pre>";
            var_dump($db_ans);
          echo "</pre>";
          echo "<pre>";
            var_dump($inp_ans);
          echo "<pre>";

          $score++;
          echo "一致\n";
          break;
          
        } else {
          echo "不一致\n";
        }
      }

    }

  }

  echo($score);

?>