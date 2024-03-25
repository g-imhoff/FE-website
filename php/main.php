<?php
    include_once 'db-connect.php';

?>

<?php 
    $sql = "SELECT * FROM youtube_video ORDER BY date DESC LIMIT 1";
    $result = mysqli_query($conn, $sql);
    $resultCheck = mysqli_num_rows($result);
    
    if($resultCheck > 0) {
        while($row = $result->fetch_assoc()) {


    
?>

<head>
    <link rel="stylesheet" href="./css/main.css">
</head>

<body>
    <main>
        <div class="box">
            <div class="title-container">
                <div class="title-box">
                    <h1>
                    <?php   
                                echo $row['Title'];

                    ?>
                    </h1>
                </div>
            </div>

            <div class = "video-container">
                <iframe class="youtube-video" src="<?php echo $row['Link'];}} ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>

            <div class = "button-container">
                <button></button>
            </div>
        </div>
    </main>
</body>

