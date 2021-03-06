<?php
  session_start();

  require_once "./common/htmlspecialchars.php";

  //入力内容を持たないアクセスやURLからのアクセスは入力画面へ遷移
  if (!isset($_SESSION['input_data'])) {
      header('Location:update_form.php');
      exit();
  }

  $_POST = $_SESSION['input_data'];

  $id = $_POST['id'];
  $question = $_POST['question'];

  $answers = $_POST['answers'];

?>

<!DOCTYPE html>
<html lang="ja">
  <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta http-equiv="X-UA-Compatible" content="ie=edge">
      <title>確認画面</title>
  </head>
  <body>
    <?php include("./common/header.php"); ?>
    <h2>確認画面</h2>

    <h3>下記の内容に変更しますか？</h3>
    <form action="update.php" method="POST">
      <div class="element_wrap">  
        <p>問題：</p>
        <textarea readonly name="question"><?php echo h($question) ?></textarea>
        <input type="hidden" name="id" value="<?php echo h($id) ?>">
      </div>
      <div class="element_wrap"> 
       
        <?php
          for($i = 0 ; $i < count($answers['answer_ids']); $i++){
        ?>
        
          <lavel>答え：</lavel><br>
          <input type="text" readonly name="answers[answers][]" value="<?php echo h($answers['answers'][$i]) ?>"><br>

          <input type="hidden" name="answers[answer_ids][]" value="<?php echo h($answers['answer_ids'][$i]) ?>">
        
        <?php } ?>
      
      </div>
      <input type="submit" value="送信">
    </form>
  </body>
</html>