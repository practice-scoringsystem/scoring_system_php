<?php
  session_start();

  require_once "../classes/Questions.php";
  require_once "../classes/CorrectAnswers.php";
  require_once "./common/htmlspecialchars.php";

  $questions = new Questions();
  $result = $questions->getById($_GET['id']);

  $id = $result['id'];
  $question = $result['question'];

  $CA = new CorrectAnswers();
  $CAData = $CA->getAnsByQuestionsId($_GET['id']);

    // バリデーション
    // ----------未入力チェック----------//
    if (!empty($_POST) && empty($_SESSION['input_data'])) {

        //問題チェック
        if (empty($question)) {
            $error_message['q'] = '問題を入力して下さい';
	    } elseif (strlen($question) > 500) {
            $error_message['q'] = '問題は500文字以内で入力をしてください。';
        }

        //答えチェック
        foreach ($CAData as $a) {
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
        }
    } elseif (!empty($_SESSION['input_data'])) {
        $_POST = $_SESSION['input_data'];
    }

    session_destroy();

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
    <form action="update_form.php" method="POST">
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
          <input type="submit" value="送信">
        </p>

    </form>
  </body>
</html>