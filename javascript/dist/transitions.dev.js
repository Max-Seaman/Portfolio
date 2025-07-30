"use strict";

//-------------------------------------
//      SCROLLING IN A PAGE
//-------------------------------------
//Select all tags with a href to somewhere in the page
var links = document.querySelectorAll('a[href^="#"]'); //Create scroll function

var smoothScroll = function smoothScroll(target) {
  if (target === '#') {
    // Scroll to top if href is "#"
    window.scrollTo({
      top: 0,
      behavior: 'smooth'
    });
    return;
  } else {
    // Calculate the vertical position of the element relative to the top of the page
    var height = document.querySelector(target).getBoundingClientRect().top + window.pageYOffset - 120; // For the others, scroll to relevent section

    window.scrollTo({
      top: height,
      behavior: 'smooth'
    });
  }
}; //Create a loop so the scroll is applied to each element in 'links'


for (var i = 0; i < links.length; i++) {
  links[i].addEventListener('click', function (event) {
    //Prevent harsh jump 
    event.preventDefault(); //Getting the href values

    var target = this.getAttribute('href'); // Cant be used for just #
    //Call the scroll function

    smoothScroll(target);
  });
} //-------------------------------------
//     BETWEEN PAGES TRANSITION
//-------------------------------------
//-------------------------------------
//        SIDEBAR TRANSITION
//-------------------------------------
//-------------------------------------
//     HERO TXT TYPING TRANSITION
//-------------------------------------


window.onload = function () {
  var heroText = document.querySelector('.hero__txt--main h1');
  console.log(heroText);
  var textContent = heroText.textContent; // Clear text to start typing effect

  heroText.textContent = ''; // When coming from another page it displays for a frame or 2 so make it visible using js to fix it

  heroText.style.visibility = 'visible';
  var index = 0;

  function type() {
    if (index < textContent.length) {
      heroText.textContent += textContent.charAt(index);
      index++;
      setTimeout(type, 80); // typing speed in ms
    }
  }

  type();
};
//# sourceMappingURL=transitions.dev.js.map
