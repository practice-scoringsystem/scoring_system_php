<?php
    session_start();
    require_once "./common/htmlspecialchars.php";
    //----------未入力チェック----------//
    if (!empty($_POST) && empty($_SESSION['input_data'])) {

        //問題チェック
        if (empty($_POST['question'])) {
            $error_message['q'] = '問題を入力して下さい';
	    } elseif (strlen($_POST['question']) > 500) {
            $error_message['q'] = '問題は500文字以内で入力をしてください。';
        }

        //答えチェック 配列のチェックにしないと機能しない
        foreach ($_POST['answers'] as $a) {
            if (empty($a)) {
                $error_message['ans'] = '答えを入力して下さい';
            } elseif (strlen($a) > 200) {
            $error_message['ans'] = '答えは200文字以内で入力をしてください。';
            }
        }

        //エラー内容チェック -- エラーがなければregister_confirm.phpへリダイレクト
        if (empty($error_message)) {
            $_SESSION['input_data'] = $_POST;
            header('Location:./register_confirm.php');
            exit();
        } elseif (!empty($_SESSION['input_data'])) {
            $_POST = $_SESSION['input_data'];
        }
        
    }

    session_destroy();
?>

<!DOCTYPE html>
<html lang="ja">
    <?php include("./common/header.php"); ?>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>新規投稿画面</title>
    </head>
    <body>
        <h2>新規投稿</h2>

        <form action="register_form.php" method="POST">
            <p>問題：</p>
            <textarea name="question" cols="30" rows="10"><?php echo isset($_POST['question']) ? h($_POST['question']) : ''; ?></textarea>
            <p> <?php echo isset($error_message['q']) ? $error_message['q'] : ''; ?></p>
            <p>答え：</p>
            <input type="text" name="answers[]" value="<?php echo isset($_POST['answers']) ? h($_POST['answers']) : ''; ?>"><br>
            <a> <?php echo isset($error_message['ans']) ? $error_message['ans'] : '';?></a>
            <br>
            <p>答え：</p>
            <input type="text" name="answers[]" value="<?php echo isset($_POST['answers']) ? h($_POST['answers']) : ''; ?>"><br>
            <a> <?php echo isset($error_message['ans']) ? $error_message['ans'] : '';?></a><br>
            <input type="submit" name="btn_confirm" value="確認画面へ">
        </form>
    </body>
</html>