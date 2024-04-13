<?php
$conn = connect();
$sql = "SELECT * FROM `youtube_video` WHERE id = $id";
$result = mysqli_query($conn, $sql);
$resultCheck = mysqli_num_rows($result);

if($resultCheck > 0) {
    while($row = $result->fetch_assoc()) {
        if ($lang == 'fr') {
            $title = $row['Title'];
            $short_description = $row['Short Description'];
        } else {
            $title = $row['Title English'];
            $short_description = $row['Short Description English'];
        }

        $link = $row['Link'];
        $style = $row['Style'];
        $date = $row['Date'];
        $thumbnail = $row['Thumbnail'];
    }
} else {
    header('Location: ./all-lesson.php');
}
?>

<head>
    <link rel="stylesheet" href="./css/main-lesson.css">
</head>

<body>
    <main>
        <article>
            <section>
                <?php echo '<img src="data:image/jpeg;base64,'.base64_encode($thumbnail).'"/>';?>
            </section>

            <section>
                <p><?php echo $date;?></p>
            </section>

            <section>
                <hgroup>
                    <h1><?php echo $title;?></h1>
                    <h2><?php echo $style;?></h2>
                </hgroup>
            </section>
        </article>
    </main>
</body>