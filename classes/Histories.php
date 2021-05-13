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

    // 履歴を取ってくる
    public function getHistoryByUserId($user_id) {
      if(empty($user_id)) {
        exit('IDが不正です');
      }

      $dbh = connect();

      $stmt = $dbh->prepare("SELECT * FROM histories WHERE user_id = :user_id");
      $stmt->bindValue(':user_id', (int)$user_id, PDO::PARAM_INT);
      $stmt->execute();
      $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

      if(!$result) {
        exit('ユーザーを登録してください。');
      }
      return $result;
    }
  }
?>