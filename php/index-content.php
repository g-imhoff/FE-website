<?php

require_once '../db/db-connect.php';
require_once '../lang/get-lang.php';

$db = new Database();
$conn = $db->getPDO();

header('Content-Type: application/json');

$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

if ($lang === 'fr') {
    $sql_query = "SELECT title, link, id_video FROM article WHERE date || ' 18:00:00' < datetime('now', '+2 hours') ORDER BY date DESC LIMIT 1";
} else {
    $sql_query = "SELECT titleEnglish, link, id_video FROM article WHERE date || ' 18:00:00' < datetime('now', '+2 hours') ORDER BY date DESC LIMIT 1";
}

$query = $conn->prepare($sql_query);
$query->execute();
$article = $query->fetchAll();

echo json_encode($article);

?>