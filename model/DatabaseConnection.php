<?php
  /**
   * Class holds database connection
   * Source of code: https://www.youtube.com/watch?v=bjT5PJn0Mu8
   */
  class DatabaseConnection {
    /**
     * Creates a database connection
     * @return PDO Database Connection
     */
    public function connect () {
      $server = "localhost";
      $database = "user_data";
      $username = "root";
      $password = "root";
      try {
			 return new PDO("mysql:host=$server;dbname=$database;", $username, $password);
		  }
		  catch(PDOException $e) {
			  die ("Connection Failed: " . $e->getMessage());
      }
    }
  }