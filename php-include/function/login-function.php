<?php
function createUser($email, $username, $password, $confirmPassword) {
    $db = new Database();
    $conn = $db->connect();
    global $trad;

    if ($password !== $confirmPassword) {
        disconnect($conn);
        return $trad["login"]["passNoMatch"];
    }

    if (!(filter_var($email, FILTER_VALIDATE_EMAIL))) {
        disconnect($conn);
        return $trad["login"]["emailInvalid"];
    }

    $queryVerifyEmail = $conn->prepare("SELECT id FROM `users` WHERE `email` = ?"); 
    $queryVerifyEmail->bind_param("s", $email);

    if ($queryVerifyEmail->execute()) {
        $resultVerifyEmail = $queryVerifyEmail->get_result();
    } else {
        disconnect($conn);
        return "Error: " . $sql . "<br>" . $conn->error;
    }
    $queryVerifyEmail->close();

    if ($resultVerifyEmail->num_rows > 0) {
        disconnect($conn);
        return $trad["login"]["emailExists"];
    }

    $queryVerifyUsername = $conn->prepare("SELECT id FROM `users` WHERE `username` = ?"); 
    $queryVerifyUsername->bind_param("s", $username);

    if ($queryVerifyUsername->execute()) {
        $resultVerifyUsername = $queryVerifyUsername->get_result();
    } else {
        disconnect($conn);
        return "Error: " . $sql . "<br>" . $conn->error;
    }
    $queryVerifyUsername->close();

    if ($resultVerifyUsername->num_rows > 0) {
        return $trad["login"]["userExists"];
    }

    $queryCreate = $conn->prepare("INSERT INTO users (email, username, password) VALUES (?, ?, ?)");
    $queryCreate->bind_param("sss", $email, $username, $password);

    if ($queryCreate->execute()) {
        $queryCreate->close();
        disconnect($conn);
        return "Success";
    } else {
        $queryCreate->close();
        disconnect($conn);
        return "Error: " . $sql . "<br>" . $conn->error;
    }
}

function logUser($email, $password) {
    $db = new Database();
    $conn = $db->connect();
    
    $query = $conn->prepare("SELECT `email`, `password`, `username` FROM users WHERE `email` = ? OR `username` = ?");
    $query->bind_param("ss", $email, $email);
    
    if ($query->execute()) {
        $result = $query->get_result();
    } else {
        disconnect($conn);
        return "Error: " . $sql . "<br>" . $conn->error;
    }

    $query->close();
    disconnect($conn);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        if ($row['password'] == $password) {
            $_SESSION['email'] = $row['email'];
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