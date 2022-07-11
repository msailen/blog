<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/utils/connection.php";

class User
{
  public static function getUserCount()
  {
    $conn = DB::getConnection();
    $sql = "SELECT COUNT(*) AS count FROM users";
    $result = mysqli_query($conn, $sql);
    $result = $result->fetch_assoc();
    return $result['count'];
  }

  public static function checkEmailExist($email)
  {
    $conn = DB::getConnection();
    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($result);
    return $num;
  }

  public static function registerUser($payload)
  {
    $password = password_hash($payload['password'], PASSWORD_BCRYPT);
    $conn = DB::getConnection();
    $sql = "INSERT INTO users (name, email, password, isAdmin) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $payload['name'], $payload['email'], $password, $payload['isAdmin']);
    $stmt->execute();

    $userId = $conn->insert_id;

    $_SESSION['userId'] = (int) $userId;
    $_SESSION['name'] = $payload['name'];

    $response['redirect'] = '/';

    $stmt->close();
    $conn->close();
    echo json_encode($response, JSON_PRETTY_PRINT);
    exit;
  }
}
