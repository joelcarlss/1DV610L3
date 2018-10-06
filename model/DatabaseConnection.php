<?php
namespace model;
  /**
   * Class holds database connection
   * Source of code: https://www.youtube.com/watch?v=bjT5PJn0Mu8
   */
  class DatabaseConnection {

      private $server = "localhost";
      private $database = "user_data";
      private $username = "root";
      private $password = "root";

    /**
     * Creates a database connection
     * @return PDO Database Connection
     */
    public function connect () {
      echo 'DatabaseConnection';
      try {
			 return new PDO("mysql:host=" . $this->server . ";dbname=" . $this->database . ";", $this->username, $this->password);
		  }
		  catch(PDOException $e) {
			  die ("Connection Failed: " . $e->getMessage());
      }
    }
  }