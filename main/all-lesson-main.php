<?php

$db = new Database();
$coon = $db->pdo;

$query = $coon->prepare("SELECT title, titleEnglish, link, id_video FROM article WHERE date || ' 18:00:00' < datetime('now', '+2 hours') ORDER BY date DESC LIMIT 5");


?>

<body>
    <main>

    </main>
</body>