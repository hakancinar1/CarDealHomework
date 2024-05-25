<?php

class CrudServices {
    private static $instance = null;
    private $connectDB;

    private function __construct() {
        $this->connectDB = Config::db_connect();
    }

    public static function getInstance() {
        if (self::$instance == null) {
            self::$instance = new CrudServices();
        }
        return self::$instance;
    }

    private function getDbConnection() {
        if ($this->connectDB->connect_error) {
            die("Connection failed: " . $this->connectDB->connect_error);
        }
        return $this->connectDB;
    }

    public function createUser($user_name, $user_password) {
        $query = "INSERT INTO `TBUsers` (`ID`, `UserName`, `UserPwd`) VALUES (NULL, ?, ?)";
        $connect = $this->getDbConnection();
        $stmt = $connect->prepare($query);
        $stmt->bind_param("ss", $user_name, $user_password);
        if ($stmt->execute() === TRUE) {
            $stmt->close();
            return true;
        }
        $stmt->close();
        return false;
    }

    public function checkUser($user_name, $user_password) {
        $query = "SELECT * FROM TBUsers WHERE UserName = ? AND UserPwd = ?";
        $connect = $this->getDbConnection();
        $stmt = $connect->prepare($query);
        $stmt->bind_param("ss", $user_name, $user_password);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $stmt->close();
            return true;
        }
        $stmt->close();
        return false;
    }

    public function createContact($user_name, $user_message) {
        $query = "INSERT INTO `TBContacts` (`ID`, `ContactName`, `ContactMessage`) VALUES (NULL, ?, ?)";
        $connect = $this->getDbConnection();
        $stmt = $connect->prepare($query);
        $stmt->bind_param("ss", $user_name, $user_message);
        if ($stmt->execute() === TRUE) {
            $stmt->close();
            return true;
        }
        $stmt->close();
        return false;
    }

    public function getContactList() {
        $query = "SELECT * FROM TBContacts ORDER BY ID DESC";
        $connect = $this->getDbConnection();
        $result = $connect->query($query);
        if ($result->num_rows > 0) {
            $rows = $result->fetch_all(MYSQLI_ASSOC);
            return $rows;
        }
        return null;
    }

    public function createProduct($CarName, $ImagePath) {
        $query = "INSERT INTO `TBProducts` (`ID`, `CarName`, `ImagePath`) VALUES (NULL, ?, ?)";
        $connect = $this->getDbConnection();
        $stmt = $connect->prepare($query);
        $stmt->bind_param("ss", $CarName, $ImagePath);
        if ($stmt->execute() === TRUE) {
            $stmt->close();
            return true;
        }
        $stmt->close();
        return false;
    }
}
?>
