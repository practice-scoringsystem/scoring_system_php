<?php

  // 変数の初期化
  $page_flag = 0;
  if(!empty($_POST['btn_confirm'])) {
    $page_flag = 1;
  }

  function h($s) {
    return htmlspecialchars($s, ENT_QUOTES, "UTF-8");
  }

?>

<!DOCTYPE html>
<html lang="ja">
    <?php include("./common/header.php"); ?>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>新規投稿</title>
    </head>
    <body>
        <h2>新規投稿</h2>

        <!-- 確認ページ -->
        <?php if( $page_flag === 1 ): ?>
            <form action="questions_create.php" method="POST">
                <div class="element_wrap">
                    <label>問題：</label>
                    <textarea readonly><?php echo h($_POST['question']) ?></textarea>
                </div>
                <div class="element_wrap">
                    <?php
                      $answers = $_POST['answers'];
                      for($i = 0 ; $i < count($answers); $i++){
                    ?>
                        <lavel>答え：</lavel><input type="text" readonly name="answers[]" value="<?php echo h($answers[$i]) ?>"><br>
                    <?php } ?>
                </div>
                <input type="submit" name="btn_submit" value="登録する">
                <input type="hidden" name="question" value="<?php echo h($_POST['question']) ?>">
            </form>

        <!-- 新規登録画面 -->
        <?php else: ?>

            <form action="" method="POST">
                <p>問題：</p>
                <textarea name="question" id="question" cols="30" rows="10"></textarea>
                <p>答え：</p>
                <input type="text" name="answers[]">
                <br>
                <p>答え：</p>
                <input type="text" name="answers[]">
                <input type="submit" name="btn_confirm" value="送信">
            </form>

        <?php endif; ?>
    </body>
</html>