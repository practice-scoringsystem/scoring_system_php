<?php
  session_start();

  require_once "../classes/Questions.php";
  require_once "../classes/CorrectAnswers.php";
  require_once "./common/htmlspecialchars.php";

  $page_flag = 0;

  if( !empty($_POST['form_validation']) ) {
    $page_flag = 1;
  }

  // 編集画面①を出す
  if( !empty($_GET['id']) && !$page_flag == 1) {

    $questions = new Questions();
    $result = $questions->getById($_GET['id']);

    $id = $result['id'];
    $question = $result['question'];

    $CA = new CorrectAnswers();
    $CAData = $CA->getAnsByQuestionsId($_GET['id']);

  // 編集画面②を出す
  } elseif (!empty($_POST) && $page_flag == 1) {

    $id = $_POST['id'];
    $question = $_POST['question'];

    $answers = $_POST['answers'];

     //問題チェック
     if (empty($question)) {
      $error_message['q'] = '問題を入力して下さい';
    } elseif (strlen($question) > 500) {
      $error_message['q'] = '問題は500文字以内で入力をしてください。';
    }

    //答えチェック 配列のチェックにしないと機能しない
    for ($i = 0; $i < count($answers['answers']); $i++) {
      if (empty($answers['answers'][$i])) {
        $error_message['ans'] = '答えを入力して下さい';
      } elseif (strlen($answers['answers'][$i]) > 200) {
        $error_message['ans'] = '答えは200文字以内で入力をしてください。';
      }
    }

    //エラー内容チェック -- エラーがなければupdate_confirm.phpへリダイレクト
    if (empty($error_message)) {
      $_SESSION['input_data'] = $_POST;
      var_dump($_POST);
      
      header('Location:./update_confirm.php');
      exit();
    } elseif (!empty($_SESSION['input_data'])) {
      $_POST = $_SESSION['input_data'];
    }
  
  }

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

    <!-- 編集画面② -->
    <?php if( $page_flag === 1 ): ?>
      <form action="" method="POST">
        <input type="hidden" name="id" value="<?php echo h($id) ?>">
        <p>問題：</p>
        <textarea name="question" cols="30" rows="10"><?php echo isset($question) ? h($question) : ''; ?></textarea>
        <p> <?php echo isset($error_message['q']) ? $error_message['q'] : ''; ?></p>
        
        <?php
          for($i = 0 ; $i < count($answers['answer_ids']); $i++){
        ?>
          <tr>
            <p>答え：</p>
            <td><input type="text" name="answers[answers][]" value="<?php echo isset($answers['answers']) ? h($answers['answers'][$i]) : ''; ?>"></td><br>
            <a> <?php echo isset($error_message['ans']) ? $error_message['ans'] : '';?></a><br>
            
            <td><input type="hidden" name="answers[answer_ids][]" value="<?php echo h($answers['answer_ids'][$i]) ?>"></td>
          </tr>
        <?php } ?>
        <p>
          <input type="submit" value="送信">
        </p>
      </form>
    
    <?php else: ?>
      <!-- 編集画面① -->
      <form action="" method="POST">
          <input type="hidden" name="id" value="<?php echo h($id) ?>">
          <p>問題：</p>
          <textarea name="question" cols="30" rows="10"><?php echo isset($question) ? h($question) : ''; ?></textarea>
          <p> <?php echo isset($error_message['q']) ? $error_message['q'] : ''; ?></p>
          
          <?php foreach($CAData as $ca_column): ?>
            <tr>
              <p>答え：</p>
              <td><input type="text" name="answers[answers][]" value="<?php echo isset($ca_column['answer']) ? h($ca_column['answer']) : ''; ?>"></td><br>
              <a> <?php echo isset($error_message['ans']) ? $error_message['ans'] : '';?></a><br>
              
              <input type="hidden" name="answers[answer_ids][]" value="<?php echo h(($ca_column)['id']) ?>">
            </tr>
          <?php endforeach; ?>
          <p>
            <input type="submit" name="form_validation" value="送信">
          </p>
      </form>
    <?php endif; ?>
  </body>
</html>