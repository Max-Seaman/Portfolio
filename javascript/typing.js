// -------------------------------------
//     HERO TXT TYPING TRANSITION
// -------------------------------------
window.onload = () => {
    const heroText = document.querySelector('.hero__txt--main h2');
    const textContent = heroText.textContent;
    // Clear text to start typing effect
    heroText.textContent = ''; 
    // When coming from another page it displays for a frame or 2 so make it visible using js to fix it
    heroText.style.visibility = 'visible';
    let index = 0;

    function type() {
        if (index < textContent.length) {
        heroText.textContent += textContent.charAt(index);
        index++;
        setTimeout(type, 80); // typing speed in ms
        }
    }

    type();
};