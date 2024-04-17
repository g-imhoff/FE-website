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
    
        if ($password !== $confirmPassword) {
            return $trad["login"]["passNoMatch"];
        }
    
        if (!(filter_var($email, FILTER_VALIDATE_EMAIL))) {
            return $trad["login"]["emailInvalid"];
        }
    
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
                $_SESSION['email'] = $result['email'];
                $_SESSION['username'] = $result['username'];
    
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
    
}

$db = new Database();

if(session_id() == '' || !isset($_SESSION) || session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!(isset($_COOKIE['username']))) {
    if (isset($_SESSION['username'])) {
        setcookie('username', $_SESSION['username'], time() + 3600 * 24 * 7, '/'); // le cookie reste 7 jours
        setcookie('email', $_SESSION['email'], time() + 3600 * 24 * 7, '/'); // le cookie reste 7 jours
    }
} else if (!(isset($_SESSION['username']))) {
    if (isset($_COOKIE['username'])) {
        $_SESSION['username'] = $_COOKIE['username'];
        $_SESSION['email'] = $_COOKIE['email'];
    }
}

if (isset($_COOKIE['username'])) {
    if(!($db->checkAccountExist($_COOKIE['username']))) {
        unset($_COOKIE['username']);
        unset($_COOKIE['email']);
    }
}

if (isset($_SESSION['username'])) {
    if(!($db->checkAccountExist($_SESSION['username']))) {
        session_destroy();
        unset($_SESSION['username']);
        unset($_SESSION['email']);
    }
}

if (isset($_COOKIE['email'])) {
    if(!($db->checkAccountExist($_COOKIE['email']))) {
        unset($_COOKIE['username']);
        unset($_COOKIE['email']);
    }
}

if (isset($_SESSION['email'])) {
    if(!($db->checkAccountExist($_SESSION['email']))) {
        session_destroy();
        unset($_SESSION['username']);
        unset($_SESSION['email']);
    }
}

?>