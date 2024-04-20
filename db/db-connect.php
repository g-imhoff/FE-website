<?php
class Database {
    private $pdo;

    public function __construct() {
        $dbPath = __DIR__ . '/fe_website.db';
        $this->pdo = new PDO('sqlite:' . $dbPath);
    }

    public function getPDO() {
        return $this->pdo;
    }

    public function createIemeTableTest($i) {
        $conn = $this->pdo;
        $query = $conn->prepare("CREATE TABLE IF NOT EXISTS test" . $i . "(id_test INTEGER PRIMARY KEY, test TEXT)");
        if ($query->execute()) {
            return "Success";
        } else {
            return "Error: " . $sql . "<br>" . $conn->error;
        }
    }
    
    public function verifyAdmin($username) {
        $username = htmlspecialchars($username);

        $conn = $this->pdo;
        $query = $conn->prepare("SELECT admin FROM users WHERE `username` = ?");

        if ($query->execute([$username])) {
            $result = $query->fetch(PDO::FETCH_ASSOC);
        } else {
            return "Error: " . $sql . "<br>" . $conn->error;
        }
        
        return $result["admin"];
    }

    public function checkAccountExist($usernameEmail) {
        $usernameEmail = htmlspecialchars($usernameEmail);

        $conn = $this->pdo;
        $sql = $conn->prepare("SELECT * FROM users WHERE username = ? OR email = ?");
        $sql->execute([$usernameEmail, $usernameEmail]);
        $row = $sql->fetch();

        if (isset($row['username']) && isset($row['email'])) {
            return true;
        } else {
            return false;
        }
    }
}

$db = new Database();

if (isset($_COOKIE['username'])) {
    if(!($db->checkAccountExist($_COOKIE['username']))) {
        unset($_COOKIE['username']);
        unset($_COOKIE['email']);
    }
}

if (isset($_COOKIE['email'])) {
    if(!($db->checkAccountExist($_COOKIE['email']))) {
        unset($_COOKIE['username']);
        unset($_COOKIE['email']);
    }
}

?>