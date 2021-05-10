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

        <form action="register_confirm.php" method="POST">
            <p>問題：</p>
            <textarea name="question" id="question" cols="30" rows="10"></textarea>
            <p>答え：</p>
            <input type="text" name="answers[]">
            <br>
            <p>答え：</p>
            <input type="text" name="answers[]"><br>
            <input type="submit" name="btn_confirm" value="確認画面へ">
        </form>
    </body>
</html>