<?php
function createUser($email, $username, $password, $confirmPassword) {
    $conn = connect();

    if ($password !== $confirmPassword) {
        global $trad;
        return $trad["login"]["passNoMatch"];
    }

    if (!(filter_var($email, FILTER_VALIDATE_EMAIL))) {
        global $trad;
        return $trad["login"]["emailInvalid"];
    }

    $sqlVerify = "SELECT id FROM `users` WHERE `email` = '$email'"; 
    $result = $conn->query($sqlVerify);

    if ($result->num_rows > 0) {
        global $trad;
        return $trad["login"]["emailExists"];
    }

    $sqlVerify = "SELECT id FROM `users` WHERE `username` = '$username'"; 
    $result = $conn->query($sqlVerify);

    if ($result->num_rows > 0) {
        global $trad;
        return $trad["login"]["userExists"];
    }

    $sql = "INSERT INTO users (email, username, password) VALUES ('$email', '$username', '$password')";

    if ($conn->query($sql) === TRUE) {
        return "Success";
    } else {
        return "Error: " . $sql . "<br>" . $conn->error;
    }
}

function logUser($email, $password) {
    $conn = connect();
    
    $sql = "SELECT `password`, `username` FROM users WHERE `email` = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo $row['password'];
        echo $password;
        if ($row['password'] == $password) {
            $_SESSION['email'] = $email;
            $_SESSION['username'] = $row['username'];

            return "Success";
        } else {
            return "Password is incorrect";
        }
    } else {
        return "Email is incorrect";
    }
}
?>