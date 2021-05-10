<?php
  session_start();
  require_once "./common/htmlspecialchars.php";

  //入力内容を持たないアクセスやURLからのアクセスは入力画面へ遷移
  if (!isset($_SESSION['input_data'])) {
      header('Location:register_form.php');
      exit();
  }

  $_POST = $_SESSION['input_data'];

  $question = $_POST['question'];

  $answers = $_POST['answers'];

  session_destroy();

?>

<!DOCTYPE html>
<html lang="ja">
    <?php include("./common/header.php"); ?>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>確認画面</title>
    </head>
    <body>
        <h2>確認画面</h2>

            <form action="questions_create.php" method="POST">
                <div class="element_wrap">
                    <label>問題：</label>
                    <textarea readonly name="question"><?php echo h($question) ?></textarea>
                </div>
                <div class="element_wrap">
                    <?php
                      for($i = 0 ; $i < count($answers); $i++){
                    ?>
                        <lavel>答え：</lavel><input type="text" readonly name="answers[]" value="<?php echo h($answers[$i]) ?>"><br>
                    <?php } ?>
                </div>
                <input type="submit" name="btn_submit" value="登録する">
            </form>

    </body>
</html>