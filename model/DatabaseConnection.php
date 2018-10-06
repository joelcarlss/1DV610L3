<?php
namespace model;
use Exception;
// use PDO;
  /**
   * Class holds database connection
   * Source of code: https://www.youtube.com/watch?v=bjT5PJn0Mu8
   */
  class DatabaseConnection {

      private $server = "localhost";
      private $database = "user_data";
      private $username = "root";
      private $password = "";

    /**
     * Creates a database connection
     * @return PDO Database Connection
     */
    public function connect () {
      $server = "localhost";
      $database = "user_data";
      $username = "root";
      $password = '';

      try {
        return new \PDO("mysql:host=$server;dbname=$database;", $username, $password);
			//  return new PDO("mysql:host=" . $this->server . ";dbname=" . $this->database . ";", $this->username, $this->password);
		  }
		  catch(PDOException $e) {
			  die ("Connection Failed: " . $e->getMessage());
      }
    }
  }