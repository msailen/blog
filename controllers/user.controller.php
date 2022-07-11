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
    $stmt->close();
    $conn->close();
    return $userId;
  }

  public static function loginUser($email, $password)
  {
    $conn = DB::getConnection();

    $stmt = $conn->prepare("SELECT id, name, isAdmin, password FROM users WHERE email =?");
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $stmt->bind_result($userId, $name, $isAdmin, $hash);
    while ($stmt->fetch()) {
      if (password_verify($password, $hash)) {
        $response['userId'] = $userId;
        $response['name'] = $name;
        $response['isAdmin'] = $isAdmin;
        return $response;
      } else {
        return false;
      }
    }
  }
}
