<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . "/controllers/user.controller.php";


if (!empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['confirmPassword'])) {

  $response = [];

  if ($_POST['password'] !== $_POST['confirmPassword']) {
    $response['error'] = "Password Mismatch. Please Try Again";
    echo json_encode($response, JSON_PRETTY_PRINT);
    return;
  }
  $exists = User::checkEmailExist($_POST['email']);
  if ($exists !== 0) {
    $response['error'] = "Email Already Exists";
    echo json_encode($response, JSON_PRETTY_PRINT);
    return;
  }
  $_SESSION['name'] = "Ram";
  $userCount = User::getUserCount();
  $userCount = (int) $userCount;
  $payload['name'] = $_POST['name'];
  $payload['email'] = $_POST['email'];
  $payload['password'] = $_POST['password'];
  $payload['isAdmin'] = 0;
  if ($userCount === 0) $payload['isAdmin'] = 1;

  $response = User::registerUser($payload);
  return $response;
} else {
  $response = [];
  $response['error'] = "All Fields Are Required";
  echo json_encode($response, JSON_PRETTY_PRINT);
}
