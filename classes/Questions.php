<?php
require_once '../dbconnect.php';

  // 全件取得
  class Questions{
    public function getAll() {
      $dbh = connect();
      $sql = "SELECT * FROM questions";
      $stmt = $dbh->query($sql);
      $result = $stmt->fetchall(PDO::FETCH_ASSOC);
      return $result;
  }

  // ランダム全件取得
  public function getRndAll() {
    $dbh = connect();
    $sql = "SELECT * FROM questions ORDER BY RAND()";
    $stmt = $dbh->query($sql);
    $result = $stmt->fetchall(PDO::FETCH_ASSOC);
    return $result;
  }

// 新規登録
  public function questionCreate($questions) {
    $sql = 'INSERT INTO
              questions(question, created_at)
            VALUES
              (:question, CURRENT_TIMESTAMP())';

    $dbh = connect();
    $dbh->beginTransaction();
    try {
      $stmt = $dbh->prepare($sql);
      $stmt->bindValue(':question', $questions['question'], PDO::PARAM_STR);
      $stmt->execute();
      $dbh->commit();
    } catch(PDOException $e) {
        $dbh->rollBack();
      exit($e);
    }
  }

// １件取得
  public function getById($id) {
    if(empty($id)) {
      exit('IDが不正です');
    }

    $dbh = connect();

    $stmt = $dbh->prepare("SELECT * FROM questions WHERE id = :id");
    $stmt->bindValue(':id', (int)$id, PDO::PARAM_INT);

    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if(!$result) {
      exit('問題を登録してください。');
    }
    return $result;
  }

  // 更新
  public function questionUpdate($questions){
    $sql = "UPDATE questions SET
              question = :question
            WHERE
              id = :id";

    $dbh = connect();
    $dbh->beginTransaction();
    try {
      $stmt = $dbh->prepare($sql);
      $stmt->bindValue(':question', $questions['question'], PDO::PARAM_STR);
      $stmt->bindValue(':id', $questions['id'], PDO::PARAM_INT);
      $stmt->execute();
      $dbh->commit();
    } catch(PDOException $e) {
        $dbh->rollBack();
      exit($e);
    }
  }

  // 削除機能
  public function delete($id) {
    if(empty($id)) {
      exit('IDが不正です');
    }

    $dbh = connect();

    $stmt = $dbh->prepare("DELETE FROM questions WHERE id = :id");
    $stmt->bindValue(':id', (int)$id, PDO::PARAM_INT);

    $stmt->execute();
  }
}
?>