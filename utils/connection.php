<?php

class DB
{
  protected static $conn;
  protected static $servername = "localhost";
  protected static $username = "blog";
  protected static $password = 'T$mp1234';
  protected static $db = "blog-project";

  private function __construct()
  {
    self::$conn = new mysqli(self::$servername, self::$username, self::$password, self::$db);

    if (self::$conn->connect_error) {
      die("Connection failed: " . self::$conn->connect_error);
    }
  }


  public static function getConnection()
  {
    if (!self::$conn) {
      new DB();
    }
    return self::$conn;
  }
}
