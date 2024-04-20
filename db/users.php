<?php

class Users { 
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function createUser($email, $username, $password, $confirmPassword) {
        $email = htmlspecialchars($email);
        $username = htmlspecialchars($username);
        $password = htmlspecialchars($password);
        $confirmPassword = htmlspecialchars($confirmPassword);

        $email = trim($email);
        $username = trim($username);
        $password = trim($password);
        $confirmPassword = trim($confirmPassword);

        global $trad;

        if (empty($email) || empty($username) || empty($password) || empty($confirmPassword)) {
            return $trad["login"]["empty"];
        }

        if (strlen($username) > 50) {
            return $trad["login"]["userLong"];
        }

        if (strlen($email) > 255) {
            return $trad["login"]["emailLong"];
        }

        if (strlen($password) > 128) {
            return $trad["login"]["passLong"];
        }

        //doesnt need to check password confirmation because it needs anyways to be equal to password so < than 255 and not ""

        if (!(filter_var($email, FILTER_VALIDATE_EMAIL))) {
            return $trad["login"]["emailInvalid"];
        }

        if ($password !== $confirmPassword) {
            return $trad["login"]["passNoMatch"];
        }

        $conn = $this->db->getPDO();

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
        $email = htmlspecialchars($email);
        $password = htmlspecialchars($password);

        $email = trim($email);
        $password = trim($password);

        if (empty($email) || empty($password)) {
            return $trad["login"]["empty"];
        }

        if (strlen($email) > 255) {
            return $trad["login"]["emailLong"];
        }

        if (strlen($password) > 128) {
            return $trad["login"]["passLong"];
        }

        $conn = $this->db->getPDO();
        
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

}

?>