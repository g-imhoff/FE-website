function showClass(className) {
    element= document.querySelector(className);

    if (element.style.display == 'flex') element.style.display = 'none';
    else element.style.display = 'flex';
}