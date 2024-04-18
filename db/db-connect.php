<?php
class Database {
    public $pdo;

    public function __construct() {
        $dbPath = __DIR__ . '/fe_website.db';
        $this->pdo = new PDO('sqlite:' . $dbPath);
    }

    public function createUser($email, $username, $password, $confirmPassword) {
        $conn = $this->pdo;
        global $trad;

        $queryVerifyEmail = $conn->prepare("SELECT id FROM `users` WHERE `email` = ?"); 
    
        if ($queryVerifyEmail->execute([$email])) {
            $resultVerifyEmail = $queryVerifyEmail->fetch();
        } else {
            return "Error: " . $sql . "<br>" . $conn->error;
        }
    
        if (isset($resultVerifyEmail['id'])) {
            return $trad["login"]["emailExists"];
        }
    
        $queryVerifyUsername = $conn->prepare("SELECT id FROM `users` WHERE `username` = ?"); 
    
        if ($queryVerifyUsername->execute([$username])) {
            $resultVerifyUsername = $queryVerifyUsername->fetch();
        } else {
            return "Error: " . $sql . "<br>" . $conn->error;
        }
    
        if (isset($resultVerifyUsername['id'])) {
            return $trad["login"]["userExists"];
        }
    
        $queryCreate = $conn->prepare("INSERT INTO users (email, username, password) VALUES (?, ?, ?)");
    
        if ($queryCreate->execute([$email, $username, $password])) {
            return "Success";
        } else {
            return "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    public function logUser($email, $password) {
        $db = new Database();
        $conn = $this->pdo;
        
        $query = $conn->prepare("SELECT `email`, `password`, `username` FROM users WHERE `email` = ? OR `username` = ?");
        
        if ($query->execute([$email, $email])) {
            $result = $query->fetch(PDO::FETCH_ASSOC);
        } else {
            return "Error: " . $sql . "<br>" . $conn->error;
        }
    
        if ($result !== NULL) {
            if ($result['password'] == $password) {
                setcookie('email', $result['email'], [
                    'expires' => time() + 3600 * 24 * 7, // Exemple d'expiration dans une heure
                    'path' => '/', // Chemin pour lequel le cookie est valide
                    'samesite' => 'Strict' // Définit l'attribut SameSite à Strict
                ]);

                setcookie('username', $result['username'], [
                    'expires' => time() + 3600 * 24 * 7, // Exemple d'expiration dans une heure
                    'path' => '/', // Chemin pour lequel le cookie est valide
                    'samesite' => 'Strict' // Définit l'attribut SameSite à Strict
                ]);
                
                return "Success";
            } else {
                return "Password is incorrect";
            }
        } else {
            return "Email is incorrect";
        }
    }

    public function verifyAdmin($username) {
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

    public function createIemeTableTest($i) {
        $conn = $this->pdo;
        $query = $conn->prepare("CREATE TABLE IF NOT EXISTS test" . $i . "(id_test INTEGER PRIMARY KEY, test TEXT)");
        if ($query->execute()) {
            return "Success";
        } else {
            return "Error: " . $sql . "<br>" . $conn->error;
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