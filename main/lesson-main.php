<?php
$db = new Database();
$conn = $db->pdo;
$sql = $conn->prepare("SELECT * FROM `article` WHERE id_video = ?");
$sql->execute([$id]);
$result = $sql->fetch();

if($result !== false) {
    $title = $result['title'];
    $article = $result['article'];
    $categorie = $result['categorie'];
    $style = $result['style'];
    $madeBy = $result['madeBy'];
    $link = $result['link'];
    $creatorLink = $result['creatorLink'];
    $date = $result['date'];
    $thumbnail = $result['thumbnail'];
    $articleEn = $result['articleEnglish'];
    $titleEn = $result['titleEnglish'];
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
                <?php echo '<img src="'. $thumbnail .'"/>';?>
            </section>

            <section>
                <p><?php echo $date;?></p>
            </section>

            <section>
                <hgroup>
                    <h1><?php echo $title;?></h1>
                    <h2><?php echo $style;?>, <?php echo $categorie ?></h2>
                    <h3><a href="<?php echo $link;?>"><?php echo $trad['lesson']['madeBy'] . ' ' . $madeBy;?></a></h3>
                </hgroup>
            </section>

            <section class="article-section">
                <h1>Article : </h1>

                <p>
                    <?php
                        if ($lang ==='fr') {
                            echo $article;
                        } else {
                            echo $articleEn;
                        }
                    ?>
                </p>
            </section>
        </article>
    </main>
</body>