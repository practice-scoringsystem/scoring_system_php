<?php
  ini_set("display_errors", 1);
  error_reporting(E_ALL);

  require_once '../dbconnect.php';

  class Histories{
    // 採点履歴登録
    public function historiesCreate($histories) {
      $sql = 'INSERT INTO
                histories(user_id, point, created_at)
              VALUES
                (:user_id, :point, CURRENT_TIMESTAMP())';

      $dbh = connect();
      $dbh->beginTransaction();
      try {
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(':user_id', (int)$histories['user_id'], PDO::PARAM_INT);
        $stmt->bindValue(':point', (int)$histories['point'], PDO::PARAM_INT);
        $stmt->execute();
        $dbh->commit();
      } catch(PDOException $e) {
          $dbh->rollBack();
        exit($e);
      }
    }
  }
?>