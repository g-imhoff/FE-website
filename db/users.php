<?php

class Users { 
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function createUser($email, $username, $password, $confirmPassword) {
        $args = func_get_args();
        $args = array_map('htmlspecialchars', $args);
        $args = array_map('trim', $args);

        global $trad;

        if (empty($args[0]) || empty($args[1]) || empty($args[2]) || empty($args[3])) {
            return $trad["login"]["empty"];
        }

        if (strlen($args[1]) > 50) {
            return $trad["login"]["userLong"];
        }

        if (strlen($args[0]) > 255) {
            return $trad["login"]["emailLong"];
        }

        if (strlen($args[2]) > 128) {
            return $trad["login"]["passLong"];
        }

        //doesnt need to check password confirmation because it needs anyways to be equal to password so < than 255 and not ""

        if (!(filter_var($args[0], FILTER_VALIDATE_EMAIL))) {
            return $trad["login"]["emailInvalid"];
        }

        if ($args[2] !== $args[3]) {
            return $trad["login"]["passNoMatch"];
        }

        $conn = $this->db->getPDO();

        $queryVerifyEmail = $conn->prepare("SELECT id FROM `users` WHERE `email` = ?"); 
    
        if ($queryVerifyEmail->execute([$args[0]])) {
            $resultVerifyEmail = $queryVerifyEmail->fetch();
        } else {
            return "Error: " . $sql . "<br>" . $conn->error;
        }
    
        if (isset($resultVerifyEmail['id'])) {
            return $trad["login"]["emailExists"];
        }
    
        $queryVerifyUsername = $conn->prepare("SELECT id FROM `users` WHERE `username` = ?"); 
    
        if ($queryVerifyUsername->execute([$args[1]])) {
            $resultVerifyUsername = $queryVerifyUsername->fetch();
        } else {
            return "Error: " . $sql . "<br>" . $conn->error;
        }
    
        if (isset($resultVerifyUsername['id'])) {
            return $trad["login"]["userExists"];
        }
    
        $queryCreate = $conn->prepare("INSERT INTO users (email, username, password) VALUES (?, ?, ?)");
    
        if ($queryCreate->execute([$args[0], $args[1], $args[2]])) {
            return "Success";
        } else {
            return "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    public function logUser($email, $password) {
        $args = func_get_args();
        $args = array_map('htmlspecialchars', $args);
        $args = array_map('trim', $args);

        if (empty($args[0]) || empty($args[1])) {
            return $trad["login"]["empty"];
        }

        if (strlen($args[0]) > 255) {
            return $trad["login"]["emailLong"];
        }

        if (strlen($args[1]) > 128) {
            return $trad["login"]["passLong"];
        }

        $conn = $this->db->getPDO();
        
        $query = $conn->prepare("SELECT `email`, `password`, `username` FROM users WHERE `email` = ? OR `username` = ?");
        
        if ($query->execute([$args[0], $args[0]])) {
            $result = $query->fetch(PDO::FETCH_ASSOC);
        } else {
            return "Error: " . $sql . "<br>" . $conn->error;
        }
    
        if ($result !== NULL) {
            if ($result['password'] == $args[1]) {
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