<?php
session_start();

require_once '../classes/UserLogic.php';

$err = [];

if(!$email = filter_input(INPUT_POST, 'id')) {
  $err['id'] = 'idを記入してください。';
}
if(!$password = filter_input(INPUT_POST, 'password')) {
  $err['password'] = 'パスワードを記入してください。';
}

if (count($err) > 0) {
  $_SESSION = $err;
  header('Location: login.php');
  return;
}

if (count($err) == 0) {
  header('Location: Top.php');
}

$result = UserLogic::login($email, $password);

if (!$result) {
  header('Location: login_form.php');
  return;
}

?>