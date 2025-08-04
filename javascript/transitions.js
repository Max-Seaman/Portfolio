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
// This includes links that start with "html/", "../", or end with ".html"
const linksToPages = document.querySelectorAll(
    'a[href^="html/"], a[href^="../"], a[href$=".html"]'
);
console.log(linksToPages);

// Filter links that lead to anchors within the same page
const linksToAnchor = [];
for (const link of linksToPages) {
    if (link.href.includes('.html#')) {
        linksToAnchor.push(link);
    }
}
console.log(linksToAnchor);

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
        event.preventDefault(); // Prevent default link behavior
        const target = this.getAttribute('href');

        // Start the fade-out transition
        mainContent.classList.remove('fade-in');
        mainContent.classList.add('fade-out');

        // Close the menu and sidebar if they are open on smaller viewports
        menu.classList.remove('open');
        sidebar.classList.remove('open');
        
        // If the link is to an anchor within the same page
        if (linksToAnchor.includes(this)) {
            // split the target to get the page and hash
            const [page, hash] = target.split('#');
            setTimeout(() => {
                // Store the hash for the next page to read
                sessionStorage.setItem('scrollToHash', '#' + hash);
                window.location.href = page; // navigate without hash
            }, 600);
            return;
        } else {
            setTimeout(() => {
                window.location.href = target;
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