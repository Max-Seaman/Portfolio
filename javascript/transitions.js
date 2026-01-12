//-------------------------------------
//      SCROLLING IN A PAGE
//-------------------------------------

//Select all tags with a href to somewhere in the page
const links = document.querySelectorAll('a[href^="#"]');

//Create scroll function
const smoothScroll = (target) => {
    if (target === '#') {
        // Scroll to top if href is "#"
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
        return;
    } else {
        // Calculate the vertical position of the element relative to the top of the page
        const height = document.querySelector(target).getBoundingClientRect().top + window.pageYOffset - 120;
        // For the others, scroll to relevent section
        window.scrollTo({
            top: height,
            behavior: 'smooth'
        });
    }
}

//Create a loop so the scroll is applied to each element in 'links'
for (let i = 0; i < links.length; i++) {
    links[i].addEventListener('click', function(event){
        //Prevent harsh jump 
        event.preventDefault();

        //Getting the href values
        const target = this.getAttribute('href'); // Cant be used for just #

        //Call the scroll function
        smoothScroll(target);
    });
}

//-------------------------------------
//     BETWEEN PAGES TRANSITION
//-------------------------------------

const mainContent = document.getElementById('main-content');
// Select all links that lead to other pages
const linksToPages = document.querySelectorAll('a[href^="/"]');

// Filter links that lead to anchors within the same page
const linksToAnchor = [];
for (const link of linksToPages) {
    if (link.getAttribute('href').includes('#')) {
        linksToAnchor.push(link);
    }
}

mainContent.classList.add('fade-out'); // Start with main content hidden

window.addEventListener('load', () => {
    const storedHash = sessionStorage.getItem('scrollToHash');

    // Remove fade-out class and add fade-in class
    mainContent.classList.remove('fade-out');
    mainContent.classList.add('fade-in');

    // If there is a stored hash, scroll to it after fading in
    if (storedHash) {
        sessionStorage.removeItem('scrollToHash');
        setTimeout(() => {
        smoothScroll(storedHash);
        }, 150);
    }
});

for (const link of linksToPages) {
    link.addEventListener('click', function(event) {
        const targetHref = this.getAttribute('href');
        const [targetPage, targetHash] = targetHref.split('#');
        const currentPage = window.location.pathname;

        // Normalize homepage paths
        if (currentPage === '/index.php') currentPage = '/';
        if (targetPage === '/index.php') targetPage = '/';

        // If already on this page
        if (targetPage === currentPage) {
            event.preventDefault();
            if (targetHash) {
                // Scroll to hash
                smoothScroll('#' + targetHash);
            } else {
                // Scroll to top if no hash
                smoothScroll('body'); // or '#main-content'
            }
            return; // skip fade-out and reload
        }

        // Prevent default link behavior
        event.preventDefault();
        // Start the fade-out transition
        mainContent.classList.remove('fade-in');
        mainContent.classList.add('fade-out');

        // Close the menu and sidebar if they are open on smaller viewports
        menu.classList.remove('open');
        sidebar.classList.remove('open');
        
        if (targetHash) {
            setTimeout(() => {
                sessionStorage.setItem('scrollToHash', '#' + targetHash);
                window.location.href = targetPage;
            }, 600);
        } else {
            setTimeout(() => {
                window.location.href = targetHref;
            }, 600);
        }
    });
}

//-------------------------------------
//     SIDEBAR & MENU TRANSITION
//-------------------------------------

const menu = document.getElementById('menu');
const sidebar = document.getElementById('sidebar');

menu.addEventListener('click', () => {
    menu.classList.toggle('open');
    sidebar.classList.toggle('open');
});