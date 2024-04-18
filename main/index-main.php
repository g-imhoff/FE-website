<?php

$db = new Database();
$coon = $db->getPDO();

$query = $coon->prepare("SELECT title, titleEnglish, link, id_video FROM article WHERE date || ' 18:00:00' < datetime('now', '+2 hours') ORDER BY date DESC LIMIT 1");
$query->execute();
$article = $query->fetch();

?>

<head>
    <link rel="stylesheet" href="/css/main-index.css">
</head>

<body>
    <main>
        <div class="box">
            <div class="title-container">
                <div class="title-box">
                    <h1>
                        <?php 
                            if ($lang === 'fr') {
                                echo $article['title'];
                            } else {
                                echo $article['titleEnglish'];
                            }
                        ?>
                    </h1>
                </div>
            </div>

            <div class = "video-container">
                <iframe class="youtube-video" src="<?php echo 'https://www.youtube.com/embed/' . $article['link'];?>" 

                title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>

            <div class = "button-container">
                <a href="/lesson.php?id=<?php echo $article['id_video'];?>"><p><?php echo $trad['Main']['Start'];?></p></a>
            </div>
        </div>
    </main>
</body>

