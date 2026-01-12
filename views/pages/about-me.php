<?php

require "views/layout/head.php";

require "views/layout/sidebar.php";

?>

        <div id="main-content">
            <div class="logo">
                <h1>MS</h1> <!-- change to actual photo eventually -->
            </div>

            <div>
                <div id="about">
                    <h1>About Me</h1>
                    <p>Hi, I'm a front-end developer with a passion for building responsive, accessible websites using <strong><a href="https://developer.mozilla.org/en-US/docs/Web/HTML" target="_blank">HTML</a></strong>, <strong><a href="https://developer.mozilla.org/en-US/docs/Web/CSS" target="_blank">CSS</a></strong>, and <strong><a href="https://sass-lang.com/" target="_blank">Sass (SCSS)</a></strong>. I enjoy creating intuitive interfaces and bringing designs to life with thoughtful styling and smooth interactions.</p>
                    <h1>Beyond Code</h1>
                    <p>Outside of coding, I enjoy diving into video games and watching movies — theyre great ways to relax and spark new ideas.</p>
                </div>
                
                <div id="skills">
                    <h1>Coding Skills</h1>
                    <div class="skills__icons">
                        <div class="skills__code">
                            <i class="icon icon-html5" title="HTML5"></i>
                            <p>HTML5</p>
                        </div>
                        <div class="skills__code">
                            <i class="icon icon-css3" title="CSS3"></i>
                            <p>CSS3</p>
                        </div>
                        <div class="skills__code">
                            <i class="icon icon-sass" title="Sass (SCSS)"></i>
                            <p>SASS</p>
                        </div>
                        <div class="skills__code">
                            <i class="icon icon-javascript" title="JavaScript"></i>
                            <p>JavaScript</p>
                        </div>
                        <div class="skills__code">
                            <i class="icon icon-jquery" title="jQuery"></i>
                            <p>jQuery</p>
                        </div>
                        <div class="skills__code">
                            <i class="icon icon-php" title="PHP"></i>
                            <p>PHP</p>
                        </div>
                        <div class="skills__code">
                            <i class="icon icon-mysql" title="MySQL"></i>
                            <p>MySQL</p>
                        </div>
                        <div class="skills__code">
                            <i class="icon icon-laravel" title="Laravel"></i>
                            <p>Laravel</p>
                        </div>
                        <div class="skills__code">
                            <i class="icon icon-react" title="React"></i>
                            <p>React</p>
                        </div>
                        <div class="skills__code">
                            <i class="icon icon-tailwindcss" title="Tailwind"></i>
                            <p>Tailwind</p>
                        </div>
                        <div class="skills__code">
                            <i class="icon icon-bootstrap" title="Bootstrap"></i>
                            <p>Bootstrap</p>
                        </div>
                    </div>
                    <p>and many more to come as I progress through my remaining time on the SCS training program and learning in my own time.</p>
                </div>
            </div>

            <?php require "views/layout/footer.php"; ?>
        </div>
        <script src="../javascript/transitions.js"></script>
    </body>
</html>