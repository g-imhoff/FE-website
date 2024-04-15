function showClass(className) {
    element= document.querySelector(className);

    if (element.style.display == 'inline') element.style.display = 'none';
    else element.style.display = 'inline';
}