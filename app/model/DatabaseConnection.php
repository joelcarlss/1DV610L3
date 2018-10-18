<?php
namespace model;
use Exception;
use PDO;

  require_once('model/databaseValues.php');
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
      $server = SERVER_ADRESS;
      $database = DATABASE;
      $username = DB_USERNAME;
      $password = DB_PASSWORD;

      try {
        return $conn = new PDO("mysql:host=$server;dbname=$database;", $username, $password);
		  }
		  catch(PDOException $e) {
			  die ("Connection Failed: " . $e->getMessage());
      }
    }
  }