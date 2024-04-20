<?php
$db = new Database();
$conn = $db->getPDO();
$sql = $conn->prepare("SELECT * FROM `article` WHERE id_video = ?");
$sql->execute([$id]);
$result = $sql->fetch();

if($result !== false) {
    $title = htmlspecialchars($result['title']);
    $article = htmlspecialchars($result['article']);
    $categorie = htmlspecialchars($result['categorie']);
    $categorieEn = htmlspecialchars($result['categorieEnglish']);
    $style = htmlspecialchars($result['style']);
    $madeBy = htmlspecialchars($result['madeBy']);
    $link = htmlspecialchars($result['link']);
    $creatorLink = htmlspecialchars($result['creatorLink']);
    $date = htmlspecialchars($result['date']);
    $thumbnail = htmlspecialchars($result['thumbnail']);
    $articleEn = htmlspecialchars($result['articleEnglish']);
    $titleEn = htmlspecialchars($result['titleEnglish']);
} else {
    header('Location: /all-lesson.php');
}
?>

<head>
    <link rel="stylesheet" href="/css/main-lesson.css">
</head>

<body>
    <main>
        <article>
            <section> 
                <a target="_blank" href="<?php echo 'https://www.youtube.com/watch?v=' . $link; ?>">
                    <?php echo '<img src="'. $thumbnail .'"/>';?>
                </a>
            </section>

            <section>
                <p><?php echo $date;?></p>
            </section>

            <section>
                <hgroup>
                    <h1>
                        <?php 
                        
                            if($lang === 'fr') {
                                echo $title;
                            } else {
                                echo $titleEn;
                            }

                        ?>
                    </h1>
                    <h2>Style : <?php echo $style;?></h2>
                    <h2><?php echo $trad['lesson']['category'] . ' : ';?>
                        <?php 
                        
                            if($lang === 'fr') {
                                echo $categorie;
                            } else {
                                echo $categorieEn;
                            }

                        ?>
                    </h2>
                    <h3><a target="_blank" href="<?php echo $link;?>"><?php echo $trad['lesson']['madeBy'] . ' ' . $madeBy;?></a></h3>
                </hgroup>
            </section>

            <section class="article-section">
                <h1>Article : </h1>

                <p>
                    <?php
                        if ($lang ==='fr') {
                            echo nl2br($article);
                        } else {
                            echo nl2br($articleEn);
                        }
                    ?>
                </p>
            </section>
        </article>
    </main>
</body>