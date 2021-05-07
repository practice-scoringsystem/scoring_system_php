<?php
require_once '../dbconnect.php';

class CorrectAnswers{

  // 全件取得
  public function getAll() {
    $dbh = connect();
    $sql = "SELECT * FROM correct_answers";
    $stmt = $dbh->query($sql);
    $result = $stmt->fetchall(PDO::FETCH_ASSOC);
    return $result;
    $dbh = null;
  }

  // 新規登録
  public function answerCreate($answers) {
    $sql = 'INSERT INTO
              correct_answers(questions_id, answer, created_at)
            VALUES
              ((select id from questions order by created_at desc limit 1), :answer, CURRENT_TIMESTAMP())';

    $dbh = connect();
    $dbh->beginTransaction();
    try {
      for($i = 0 ; $i < count($answers); $i++){
        $answer = $answers[$i];
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(':answer', $answer, PDO::PARAM_STR);
        $stmt->execute();
      }
    $dbh->commit();
    echo '登録しました。';
    } catch(PDOException $e) {
        $dbh->rollBack();
      exit($e);
    }
  }

  // １件取得
  public function getAnsById($id) {
    if(empty($id)) {
      exit('IDが不正です');
    }

    $dbh = connect();


    $stmt = $dbh->prepare("SELECT * FROM correct_answers WHERE questions_id = :id");
    $stmt->bindValue(':id', (int)$id, PDO::PARAM_INT);

    $stmt->execute();

    $result = $stmt->fetchall(PDO::FETCH_ASSOC);

    if(!$result) {
      exit('問題を登録してください。');
    }
    return $result;
  }

  //更新
  public function answerUpdate($answers){
    $sql = "UPDATE correct_answers SET
              answer = :answer
            WHERE
              id = :id";

    $dbh = connect();
    $dbh->beginTransaction();
    try {
      for($i = 0 ; $i < count($answers); $i++){
        $answer = $answers[$i];
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(':answer', $answer['answer'], PDO::PARAM_STR);
        $stmt->bindValue(':id', $answer['answer_ids'], PDO::PARAM_INT);
        $stmt->execute();
      }
    $dbh->commit();
    echo '更新しました';
    } catch(PDOException $e) {
        $dbh->rollBack();
      exit($e);
    }
  }
}
?>