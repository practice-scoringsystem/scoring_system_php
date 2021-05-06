<?php
var_dump($_POST);

// 変数の初期化
$page_flag = 0;

if( !empty($_POST['btn_confirm']) ) {
	$page_flag = 1;
}
?>

<!DOCTYPE html>
<html lang="ja">
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
                    <p><?php echo $_POST['question']; ?></p>
                </div>
                <div class="element_wrap">
                    <label>答え１：</label>
                    <p><?php echo $_POST['answer1']; ?></p>
                </div>
                <div class="element_wrap">
                    <label>答え２：</label>
                    <p><?php echo $_POST['answer2']; ?></p>
                </div>
                <input type="submit" name="btn_submit" value="登録する">
                <input type="hidden" name="question" value="<?php echo $_POST['question']; ?>">
                <input type="hidden" name="answer1" value="<?php echo $_POST['answer1']; ?>">
                <input type="hidden" name="answer2" value="<?php echo $_POST['answer2']; ?>">
            </form>

        <?php else: ?>
        <!-- 新規登録画面 -->
            <form action="" method="POST">
                <p>問題：</p>
                <textarea name="question" id="question" cols="30" rows="10"></textarea>
                <p>答え１：</p>
                <input type="text" name="answer1">
                <br>
                <p>答え２：</p>
                <input type="text" name="answer2">
                <input type="submit" name="btn_confirm" value="送信">
            </form>

        <?php endif; ?>
    </body>
</html>