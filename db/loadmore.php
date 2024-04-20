<?php

class LoadMore {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function getLoadMore($number) {
        global $trad;
        global $lang;
    
        $coon = $this->db->getPDO();
        
        $query = $coon->prepare("SELECT title, titleEnglish, link, id_video FROM article WHERE date || ' 18:00:00' < datetime('now', '+2 hours') ORDER BY date DESC LIMIT 2 OFFSET " . $number);
        $query->execute();
        $result = $query->fetchALL();
    
        foreach ($result as $row) {
            

            if ($lang === 'fr') $title = htmlspecialchars($row['title']);
            else $title = htmlspecialchars($row['titleEnglish']);

            $link = htmlspecialchars($row['link']);
            $id_video = htmlspecialchars($row['id_video']);
            echo('
            <section>
                <h1>
                    ' . $title . '
                </h1>
                <iframe class="youtube-video" src="https://www.youtube.com/embed/'. $link .'"  
                    title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                <a href="/lesson.php?id='. $id_video .'"><p>' . $trad['all-lesson']['start'] . '</p></a>
            </section>');
        }
    }
}


?>