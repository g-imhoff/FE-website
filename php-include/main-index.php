<?php
    include_once 'db-connect.php';
?>

<?php 
    $sql = "SELECT * FROM youtube_video ORDER BY date DESC LIMIT 1";
    $result = mysqli_query($conn, $sql);
    $resultCheck = mysqli_num_rows($result);
    
    if($resultCheck > 0) {
        while($row = $result->fetch_assoc()) {
            if ($lang == 'fr') {
                $title = $row['Title'];
            } else {
                $title = $row['Title English'];
            }
            $link = $row['Link'];
            $id = $row['id'];
        }} 
?>

<head>
    <link rel="stylesheet" href="./css/main-index.css">
</head>

<body>
    <main>
        <div class="box">
            <div class="title-container">
                <div class="title-box">
                    <h1>
                    <?php     
                        /* get the link of the last video in the database */
                        echo $title;
                    ?> 
                    </h1>
                </div>
            </div>

            <div class = "video-container">
                <iframe class="youtube-video" src="
                <?php     
                /* get the link of the last video in the database */
                    echo $link; 
                ?>
                " 

                title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>

            <div class = "button-container">
                <a href="./lesson.php?id=<?php echo $id?>"><p><?php echo $trad['Main']['Start']?></p></a>
            </div>
        </div>
    </main>
</body>

