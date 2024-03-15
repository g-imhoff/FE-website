window.addEventListener("load", (event) => {
    const sidebar = document.querySelector('#sidebar');
});

function showSidebar() {
    sidebar.style.display = 'flex';
}

function closeSidebar() {
    sidebar.style.display = 'none';
}