document.addEventListener('DOMContentLoaded', function() {
    var number = 0;
    var loadMoreBtn = document.getElementById('loadMore');

    loadMoreBtn.addEventListener('click', function() {
        number += 2;
        var send = '/footer/loadmore-add.php?number=' + number;
        var xhr = new XMLHttpRequest();
        xhr.open('GET', send, true);
        xhr.onload = function() {
            if (xhr.status >= 200 && xhr.status < 400) {
                var response = xhr.responseText;
                if (response.trim() === '') {
                    loadMoreBtn.style.display = 'none';
                } else {
                    var tempDiv = document.createElement('article');
                    tempDiv.innerHTML = response.trim(); 
                    document.getElementById('resultat').appendChild(tempDiv); 
                }
            } else {
                console.error('Erreur AJAX:', xhr.statusText);
            }
        };
        xhr.onerror = function() {
            console.error('Erreur AJAX:', xhr.statusText);
        };
        xhr.send();
    });
});