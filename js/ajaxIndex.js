const indexInit = async () => {
    document.addEventListener("readystatechange", function() {
        if (document.readyState === "complete") {

            fetch("../php/index-content.php")
                .then(response => response.json())
                .then((data) => {
                    const father = document.querySelector('.box');

                    data.forEach(element => {
                        let title; 
                        let start;
                        
                        if (typeof element['title'] === 'undefined') {
                            title = element['titleEnglish']
                            start = "Start the lesson"
                        } else {
                            title = element['title'];
                            start = "Commencer la leçon"
                        }

                        result = '<div class="title-container">' + 
                                    '<div class="title-container">' + 
                                        '<div class="title-box">' + 
                                            '<h1>' + title + '</h1>' +
                                        '</div>' + 
                                    '</div>' + 
                                '</div>' + 
                                '<div class = "video-container">' + 
                                    '<iframe class="youtube-video" src="https://www.youtube.com/embed/' + element['link'] + '"' + 
                                    'title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>' +
                                '</div>' + 
                                '<div class = "button-container">' + 
                                    '<a href="/lesson.php?id=' + element['id'] + '"> <p>' + start + '</p></a>' + 
                                '</div>';

                        father.innerHTML += result;
                    })

                })
        }
    })
}

indexInit()