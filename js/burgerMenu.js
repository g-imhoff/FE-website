// Show the side bar by clicking on the burger button
function showSidebar() {
    sidebar = document.querySelector('#sidebar');
    burgerMenu = document.querySelector('#burger-menu');
    box = document.querySelector('.box');
    
    box.style.display = 'none';
    sidebar.style.display = 'flex';
    burgerMenu.style.display = 'none';
}

// Close the side bar by clicking on the close button
function closeSidebar() {
    sidebar = document.querySelector('#sidebar');
    burgerMenu = document.querySelector('#burger-menu');
    box = document.querySelector('.box');

    box.style.display = 'block'
    sidebar.style.display = 'none';
    burgerMenu.style.display = 'flex';
}