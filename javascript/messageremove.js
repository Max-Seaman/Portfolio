const closeMessage = document.getElementsByClassName('closemessage');

Array.from(closeMessage).forEach(element => {
    element.addEventListener('click', () => {
        element.parentElement.remove();
    });
});