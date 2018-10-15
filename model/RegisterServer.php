<?php
namespace model;

use Exception;

class RegisterServer {

    private $dc;
    private $conn;
    public function __construct (\model\DatabaseConnection $dc) {
        $this->dc = $dc; 
        $this->conn = $dc->connect();
    }

    /**
     * Registers new user by user credentials if username is available.
     * @throws Exception if username isUsernameAvailable returns false
     */
    public function registerNewUser($user) {
        if ($this->isUsernameAvailable($user)) {
            $this->addNewUserToDatabase($user);
        } else {
            throw new Exception('User exists, pick another username.');
        }
    }

    /**
     * Checks username availability by searching database by username.
     * @return true if search turns up blank and false if something matches
     */
    private function isUsernameAvailable($user) {
        $connect = $this->dc->connect();
        $username = $user->getUsername();
        
        $records = $connect->prepare('SELECT id,username,password FROM users WHERE username = :username');
        $records->bindParam(':username', $username);
        $records->execute();
        $results = $records->fetch(\PDO::FETCH_ASSOC);

        return !$results;
    }

    /**
     * Adds new user to database
     * @return true if executuion is ok
     * @throws Exception if something goes wrong
     */
    private function addNewUserToDatabase($user) {
        $connect = $this->dc->connect();
        $username = $user->getUsername();
        $password = $user->getHashedPassword();
        $sql = "INSERT INTO users (username, password) VALUES (:username, :password)";
        $statement = $connect->prepare($sql);
        $statement->bindParam(':username', $username);
        $statement->bindParam(':password', $password);

        if ($statement->execute()) {
            return true;
        } else {
            throw new Exception ('Something went wrong');
        }
    }
}