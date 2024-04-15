<?php 
    require_once './php-include/function/db-connect.php';
?>

<?php 

function verifyAdmin($username) {
    $conn = connect();
    $query = $conn->prepare("SELECT admin FROM users WHERE `username` = ?");
    $query->bind_param("s", $username);
    if ($query->execute()) {
        $result = $query->get_result();
    } else {
        return "Error: " . $sql . "<br>" . $conn->error;
    }

    $data = $result->fetch_assoc();
    $query->close();

    return $data["admin"];
}

?>
