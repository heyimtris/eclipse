const elements = document.querySelectorAll('.sidebar ul li')

elements.forEach(element => {
element.addEventListener('contextmenu', function(event) {
    event.preventDefault();
    alert('Right-click detected on friend');
});
});