<?php

$db = new Database();
$coon = $db->pdo;

$query = $coon->prepare("SELECT title, titleEnglish, link, id_video FROM article WHERE date || ' 18:00:00' < datetime('now', '+2 hours') ORDER BY date DESC LIMIT 5");
$query->execute();
$result = $query->fetchALL();

?>

<head>
    <link rel="stylesheet" href="/css/main-all-lesson.css">
</head>

<body>
    <main>

        <?php
            foreach ($result as $row) {
                echo('
                <section>
                    <h1>
                        ' . $row['title'] . '
                    </h1>
                    <iframe class="youtube-video" src="https://www.youtube.com/embed/'. $row['link'] .'"  
                        title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    <a href="/lesson.php?id='. $row['id_video'] .'"><p>' . $trad['all-lesson']['start'] . '</p></a>
                </section>');
            }
        ?>

    </main>
</body>