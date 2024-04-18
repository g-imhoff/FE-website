<?php

class ArticleCreator {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    function sendArticle($title, $titleEn, $article, $articleEn, $category, $categoryEn, $style, $madeBy, $link, $linkCreator, $date, $thumbnail) {
        $coon = $this->db->getPDO();
    
        $query = $coon->prepare("INSERT INTO article (title, titleEnglish, article, articleEnglish, categorie, categorieEnglish, style, madeBy, link, creatorLink, date, thumbnail) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        if ($query->execute([$title, $titleEn, $article, $articleEn, $category, $categoryEn, $style, $madeBy, $link, $linkCreator, $date, $thumbnail])) {
            return "Success";
        } else {
            return "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

?>