<?php
class DatabaseConnection
{
  private $conn;
  private $server_name = "localhost";
  private $user_name = "root";
  private $password = "";
  private $dbname = "stack_book";

  public function __construct()
  {
    try {
      $this->conn = new PDO("mysql:host=$this->server_name;dbname=$this->dbname", $this->user_name, $this->password);

      $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      // echo "success";
    } catch (PDOException $e) {
      echo "connection failed" . $e->getMessage();

    }
  }

  public function get_connection()
  {
    return $this->conn;
  }
}

// $database = new DatabaseConnection();
// $conn = $database->get_connection();

?>