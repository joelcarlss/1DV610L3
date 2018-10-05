<?php
    class DatabaseConnection {
    public function connect () {
      $server = "localhost";
      $database = "users";
      $username = "asd";
      $password = "asd";
      try {
			 return new PDO("mysql:host=$server;dbname=$database;", $user, $pass);
		  }
		  catch(PDOException $e) {
			  return $e->getMessage();
      }
    }
  }