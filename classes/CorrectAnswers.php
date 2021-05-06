<?php
require_once '../dbconnect.php';

class CorrectAnswers{
  public function getAll() {
    $dbh = connect();
    $sql = "SELECT * FROM correct_answers";
    $stmt = $dbh->query($sql);
    $result = $stmt->fetchall(PDO::FETCH_ASSOC);
    return $result;
    $dbh = null;
  }

  public function answerCreate($answers) {
    $sql = 'INSERT INTO
              correct_answers(questions_id, answer, created_at)
            VALUES
              ((select id from questions order by created_at desc limit 1), :answers, CURRENT_TIMESTAMP())';

    $dbh = connect();
    $dbh->beginTransaction();
    try {
      for($i = 0 ; $i < count($answers); $i++){
        $answer = $answers[$i];
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(':answers', $answer, PDO::PARAM_STR);
        $stmt->execute();
      }
    $dbh->commit();
    echo '登録しました。';
    } catch(PDOException $e) {
        $dbh->rollBack();
      exit($e);
    }
  }
}
?>