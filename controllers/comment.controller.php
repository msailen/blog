<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/utils/connection.php";

class Comment
{

  public static function addComment($payload)
  {
    try {
      print_r($payload);
      $conn = DB::getConnection();
      $sql = "INSERT INTO comments (userId, blogId, content) VALUES (?, ?, ?)";
      $stmt = $conn->prepare($sql);
      $stmt->bind_param("sss", $payload['userId'], $payload['blogId'], $payload['content']);
      $stmt->execute();
      $stmt->close();
      $conn->close();
      return true;
    } catch (\Throwable $th) {
      return false;
    }
  }

  public static function getByBlog($id)
  {
    try {
      $conn = DB::getConnection();
      $sql = "SELECT u.name AS username, c.content as content, c.created_at AS created_at FROM comments c INNER JOIN users u ON c.userId = u.id WHERE blogId= ?";
      $stmt = $conn->prepare($sql);
      $stmt->bind_param('s', $id);
      $stmt->execute();
      $result = $stmt->get_result();
      $comments = array();
      while ($row = $result->fetch_assoc()) {
        $comments[] = $row;
      }
      $stmt->close();
      return $comments;
    } catch (\Throwable $err) {
      return false;
    }
  }
}
