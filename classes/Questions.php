<?php
require_once '../dbconnect.php';

class Questions{
  public function getAll() {
    $dbh = connect();
    $sql = "SELECT * FROM questions";
    $stmt = $dbh->query($sql);
    $result = $stmt->fetchall(PDO::FETCH_ASSOC);
    return $result;
    $dbh = null;
  }

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
}
?>