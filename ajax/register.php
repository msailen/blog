<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/controllers/user.controller.php";


if (!empty($_POST['name']) || !empty($_POST['email']) || !empty($_POST['password'])) {

  $response = [];

  $userCount = User::getUserCount();
  $userCount = (int) $userCount;

  $payload['name'] = $_POST['name'];
  $payload['email'] = $_POST['email'];
  $payload['password'] = $_POST['password'];
  $payload['isAdmin'] = 0;
  if ($userCount === 0) $payload['isAdmin'] = 1;

  $response = User::registerUser($payload);
  return $response;
}
