<?php

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
    <h2>確認画面</h2>
    <h3>下記の内容に変更しますか？</h3>
    <form action="update.php" method="POST">
      <div class="element_wrap">  
        <p>問題：</p>
        <input type="text" name="question" value="<?php echo $question ?>">
        <input type="hidden" name="id" value="<?php echo $id ?>">
      </div>
      <div class="element_wrap">  
       
        <?php
          for($i = 0 ; $i < count($answers['answer_ids']); $i++){
        ?>
        
          <lavel>答え：<?php echo $answers['answers'][$i] ?></lavel><br>
          <input type="hidden" name="answers[answers][]" value="<?php echo $answers['answers'][$i] ?>">

          <input type="hidden" name="answers[answer_ids][]" value="<?php echo $answers['answer_ids'][$i] ?>">
        
        <?php } ?>
      
      </div>
      <input type="submit" value="送信">
    </form>
  </body>
</html>