<?php

require "views/layout/head.php";

require "views/layout/sidebar.php";

?>

        <div id="main-content">
            <div class="logo">
                <h1>MS</h1> <!-- change to actual photo eventually -->
            </div>

            <div id="about">
                <h1>About Me</h1>
                <p>Hi, I'm a front-end developer with a passion for building responsive, accessible websites using <strong><a href="https://developer.mozilla.org/en-US/docs/Web/HTML" target="_blank">HTML</a></strong>, <strong><a href="https://developer.mozilla.org/en-US/docs/Web/CSS" target="_blank">CSS</a></strong>, and <strong><a href="https://sass-lang.com/" target="_blank">Sass (SCSS)</a></strong>. I enjoy creating intuitive interfaces and bringing designs to life with thoughtful styling and smooth interactions.</p>
            </div>
            
            <div id="extrainfo">
                <div class="skills">
                    <h1>Coding Skills</h1>
                    <ul>
                        <li><strong><a href="https://developer.mozilla.org/en-US/docs/Web/HTML" target="_blank">HTML</a></strong></li>
                        <li><strong><a href="https://developer.mozilla.org/en-US/docs/Web/CSS" target="_blank">CSS</a></strong></li>
                        <li><strong><a href="https://sass-lang.com/" target="_blank">Sass (SCSS)</a></strong></li>
                    </ul>
                    <p>and many more to come as I progress through my remaining time on the SCS training program</p>
                </div>
            
                <div class="interests">
                    <h1>Beyond Code</h1>
                        <p>Outside of coding, I enjoy diving into video games and watching movies — theyre great ways to relax and spark new ideas.</p>
                </div>
            </div>

            <?php require "views/layout/footer.php"; ?>
        </div>
        <script src="../javascript/transitions.js"></script>
    </body>
</html>