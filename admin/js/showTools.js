function showClass(className) {
    element= document.querySelector(className);

    if (element.style.display == 'block') element.style.display = 'none';
    else element.style.display = 'block';
}