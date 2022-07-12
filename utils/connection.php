<?php

class DB
{
  protected static $conn;
  protected static $servername = "sql6.freemysqlhosting.net";
  protected static $username = "sql6505855";
  protected static $password = 'ibqALLsx4N';
  protected static $db = "sql6505855";

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
