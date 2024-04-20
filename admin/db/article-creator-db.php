<?php

class ArticleCreator {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    function sendArticle($title, $titleEn, $article, $articleEn, $category, $categoryEn, $style, $madeBy, $link, $linkCreator, $date, $thumbnail) {
        $coon = $this->db->getPDO();

        $title = htmlspecialchars($title);
        $titleEn = htmlspecialchars($titleEn);
        $article = htmlspecialchars($article);
        $articleEn = htmlspecialchars($articleEn);
        $category = htmlspecialchars($category);
        $categoryEn = htmlspecialchars($categoryEn);
        $style = htmlspecialchars($style);
        $madeBy = htmlspecialchars($madeBy);
        $link = htmlspecialchars($link);
        $linkCreator = htmlspecialchars($linkCreator);
        $date = htmlspecialchars($date);
        $thumbnail = htmlspecialchars($thumbnail);
    
        $query = $coon->prepare("INSERT INTO article (title, titleEnglish, article, articleEnglish, categorie, categorieEnglish, style, madeBy, link, creatorLink, date, thumbnail) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        if ($query->execute([$title, $titleEn, $article, $articleEn, $category, $categoryEn, $style, $madeBy, $link, $linkCreator, $date, $thumbnail])) {
            return "Success";
        } else {
            return "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

?>