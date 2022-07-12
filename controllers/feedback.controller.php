<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/utils/connection.php";

class Feedback
{

  public static function addFeedback($payload)
  {
    try {
      $conn = DB::getConnection();
      $sql = "INSERT INTO feedbacks (name, email, message) VALUES (?, ?, ?)";
      $stmt = $conn->prepare($sql);
      $stmt->bind_param("sss", $payload['name'], $payload['email'], $payload['message']);
      $stmt->execute();
      $stmt->close();
      return true;
    } catch (\Throwable $th) {
      return false;
    }
  }

  public static function listFeedbacks()
  {
    $conn = DB::getConnection();
    $sql = "SELECT * FROM feedbacks ORDER BY id DESC";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();
    $feedbacks = array();
    while ($row = $result->fetch_assoc()) {
      $feedbacks[] = $row;
    }
    $stmt->close();
    $conn->close();
    return $feedbacks;
  }
}
