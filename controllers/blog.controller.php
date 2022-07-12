<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/utils/connection.php";

class Blog
{

  public static function addBlog($payload)
  {
    try {
      $conn = DB::getConnection();
      $sql = "INSERT INTO blogs (title, content, preview) VALUES (?, ?, ?)";
      $stmt = $conn->prepare($sql);
      $stmt->bind_param("sss", $payload['title'], $payload['content'], $payload['preview']);
      $stmt->execute();
      $stmt->close();
      $conn->close();
    } catch (\Throwable $th) {
      error_log($th->getMessage());
    }
  }

  public static function listBlogs()
  {
    $conn = DB::getConnection();
    $sql = "SELECT * FROM blogs ORDER BY id DESC";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();
    $blogs = array();
    while ($row = $result->fetch_assoc()) {
      $blogs[] = $row;
    }
    $stmt->close();
    $conn->close();
    return $blogs;
  }

  public static function getById($id)
  {
    try {
      $conn = DB::getConnection();
      $sql = "SELECT * FROM blogs WHERE id=?";
      $stmt = $conn->prepare($sql);
      $stmt->bind_param("s", $id);
      $stmt->execute();
      $result = $stmt->get_result();
      $blog = $result->fetch_assoc();
      $stmt->close();
      return $blog;
    } catch (\Throwable $err) {
      return false;
    }
  }
}
