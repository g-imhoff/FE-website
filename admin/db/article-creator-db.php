<?php

class ArticleCreator {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    function sendArticle($title, $titleEn, $article, $articleEn, $category, $categoryEn, $style, $madeBy, $link, $linkCreator, $date, $thumbnail) {
        $coon = $this->db->getPDO();

        $args = func_get_args();
        $args = array_map('htmlspecialchars', $args);
        $args = array_map('trim', $args);

        if (empty($args[0]) || empty($args[1]) || empty($args[2]) || empty($args[3]) || empty($args[4]) || empty($args[5]) || empty($args[6]) || empty($args[7]) || empty($args[8]) || empty($args[9]) || empty($args[10]) || empty($args[11])) {
            return $trad["admin"]["article-creator"]["empty"];
        }

        if (strlen($args[0]) > 128 || strlen($args[1]) > 128) {
            return $trad["admin"]["article-creator"]["titleLong"];
        }

        if (strlen($args[4]) > 64 || strlen($args[5]) > 64) {
            return $trad["admin"]["article-creator"]["categoryLong"];
        }

        if (strlen($args[6]) > 64) {
            return $trad["admin"]["article-creator"]["styleLong"];
        }
        
        if (strlen($args[7]) > 64) {
            return $trad["admin"]["article-creator"]["madeByLong"];
        }

        if (strlen($args[8]) > 512) {
            return $trad["admin"]["article-creator"]["linkLong"];
        }

        if (strlen($args[9]) > 512) {
            return $trad["admin"]["article-creator"]["linkCreatorLong"];
        }
    
        $query = $coon->prepare("INSERT INTO article (title, titleEnglish, article, articleEnglish, categorie, categorieEnglish, style, madeBy, link, creatorLink, date, thumbnail) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        if ($query->execute([$args[0], $args[1], $args[2], $args[3], $args[4], $args[5], $args[6], $args[7], $args[8], $args[9], $args[10], $args[11]])) {
            return "Success";
        } else {
            return "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

?>