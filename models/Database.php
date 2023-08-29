<?php

class Database {
    private $host = 'localhost';
    private $dbname = 'task7';
    private $username = 'root';
    private $password = '';
    private $pdo;

    public function __construct() {
        try {
            $this->pdo = new PDO("mysql:host=$this->host;dbname=$this->dbname", $this->username, $this->password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $error) {
            echo "Connection failed: " . $error->getMessage();
        }
    }

    public function query($sql, $params = []) {
        try {
            $statement = $this->pdo->prepare($sql);
            $statement->execute($params);
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        } catch(PDOException $error) {
            echo "Query failed: " . $error->getMessage();
        }
    }

    public function execute($sql, $params = []) {
        try {
            $statement = $this->pdo->prepare($sql);
            return $statement->execute($params);
        } catch(PDOException $error) {
            echo "Execution failed: " . $error->getMessage();
        }
    }

    public function createUser($username, $password, $email, $role) {
        $query = "INSERT INTO users (username, password, email, role) VALUES (:username, :password, :email, :role)";
        $params = [
            ':username' => $username,
            ':password' => $password,
            ':email' => $email,
            ':role' => $role
        ];
        return $this->execute($query, $params);
    }

    public function updateUser($id, $username, $password, $email, $role) {
        $query = "UPDATE users SET username = :username, password = :password, email = :email, role = :role WHERE id = :id";
        $params = [
            ':id' => $id,
            ':username' => $username,
            ':password' => $password,
            ':email' => $email,
            ':role' => $role
        ];
        return $this->execute($query, $params);
    }

    public function readUser($id) {
        $query = "SELECT * FROM users WHERE id = :id";
        $users = $this->query($query, [':id' => $id]);
        return !empty($users) ? $users[0] : null;
    }

    public function deleteUser($id) {
        $query = "DELETE FROM users WHERE id = :id";
        return $this->execute($query, [':id' => $id]);
    }
}

?>
