<?php

require_once '../dbconnect.php';

class CorrectAnswers{

  // 全件取得
  public function getAll() {
    $dbh = connect();
    $sql = "SELECT * FROM correct_answers";
    $stmt = $dbh->query($sql);
    $result = $stmt->fetchall(PDO::FETCH_ASSOC);
    $dbh = null;
    return $result;
  }

  // 新規登録
  public function answerCreate($answers) {
    $sql = 'INSERT INTO
              correct_answers(questions_id, answer, created_at)
            VALUES
              ((select id from questions order by created_at desc limit 1), :answer, CURRENT_TIMESTAMP())';

    // DB接続とトランザクション開始
    $dbh = connect();
    $dbh->beginTransaction();

    try {

      for($i = 0 ; $i < count($answers); $i++){
        $answer = $answers[$i];
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(':answer', $answer, PDO::PARAM_STR);
        $stmt->execute();
      }

      // 成功したらコミット
      $dbh->commit();
    } catch(PDOException $e) {
        $dbh->rollBack();
      exit($e);
    }
  }

  // １件取得
  public function getAnsByQuestionsId($id) {
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

  // 更新
  public function answerUpdate($answers){
    $sql = "UPDATE correct_answers SET
              answer = :answer
            WHERE
              id = :id";

      $temp = [];
      foreach ($answers['answers'] as $answer){
        foreach ($answers['answer_ids'] as $id){
          if (!isset($temp[$id])) {
            $temp[$id] = $answer;
            break;
          }
        }
      }

    // db接続とトランザクション開始
    $dbh = connect();
    $dbh->beginTransaction();
  
    try{
        foreach ($temp as $id => $answer){  
          $stmt = $dbh->prepare($sql);
          $stmt->execute([':answer' => $answer, ':id' => (int)$id]);
        }
    // 成功したらコミット
      $dbh->commit();

    } catch(PDOException $e) {
      $dbh->rollBack();
      exit($e);
    }
  }

  // 削除
  public function ansDelete($answers) {

    $dbh = connect();

    foreach ($answers['answer_ids'] as $id){
      $stmt = $dbh->prepare("DELETE FROM correct_answers WHERE id = :id");
      $stmt->bindValue(':id', (int)$id, PDO::PARAM_INT);
      $stmt->execute();
    }

  }

}
?>