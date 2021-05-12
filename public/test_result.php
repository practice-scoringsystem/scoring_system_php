<?php
  require_once "../classes/Questions.php";
  require_once "../classes/CorrectAnswers.php";
  require_once "../classes/UserLogic.php";

  $question_ids = $_POST['ids'];
  $inp_answers = $_POST['input_answers'];

  // $ans_arr = array();
  $score = 0;

  // DBの値を取り出す
  for($i = 0; $i < count($question_ids); $i++) {

    $q_id = (int)$question_ids[$i];
    $ca = new CorrectAnswers();
    $db_data = $ca->getAnsByQuestionsId($q_id);
   
    // 取り出したDBの値から必要な情報だけ取り出す
    $answers = array_column($db_data, 'answer');

    // フォームから入力した値を回す
    for($j = 0; $j < count($inp_answers); $j++) {
      $inp_ans = $inp_answers[$j];

      // DBの値を回す
      for($k = 0; $k < count($answers); $k++) {
        $db_ans = $answers[$k];
        
        if ($db_ans === $inp_ans) {
          $score++;
          break;
        }
      }

    }

  }

  // 問題数のカウント
  $q_count = count($question_ids);

  // 採点
  $result = round(100 * $score / $q_count);

?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>テスト結果</title>
</head>
<body>
  <?php include("./common/header.php"); ?>
  <?php
    // php.iniで上手く設定できなかったためtimezoneを設定
    date_default_timezone_set('Asia/Tokyo');
    echo date("Y/m/d H:i:s")
  ?>
</body>
</html>
