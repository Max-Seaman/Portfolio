<?php

require 'views/layout/head.php';

require 'views/layout/sidebar.php';

?>

        <div id="main-content">
            <div class="hero">
                <img src="img/hero.jpg" alt="japanese plum blossom with pagoda and mountains in the distance">
                <div class="hero__txt">
                    <div class="spacer"></div>
                    <div class="hero__txt--main">
                        <h1>My Name is Max Seaman</h1>
                        <h2>I'm a Web Developer</h2>
                    </div>
                    <div class="spacer"></div>
                    <div class="hero__txt--scroll">
                        <p>Scroll Down</p>
                        <a href="#projects"><i class="icon icon-down"></i></a>
                    </div>
                </div>
                <canvas id="petal-blossom"></canvas>
            </div>

            <div id="projects">
                <h2 class="project_heading">My Projects</h2>
                <p class="project_description">Here are some of my completed and ongoing projects. Click on any project to view it in detail.</p>
                <div class="grid">
                    <div class="project-card project-card--1 project-card--complete">
                        <div class="imgtag">
                            <img src="img/nm-homepage.jpg" alt="image of netmatters homepage">
                            <p class="tag tag--complete">HTML/CSS</p>
                        </div>
                        <div class="content">
                            <h2>Netmatters Homepage</h2>
                            <a href="https://netmatters.max-seaman.netmatters-scs.co.uk/" target="_blank">View Project <i class="icon icon-arrow"></i></a>
                            <a href="https://github.com/Max-Seaman/Netmatters-Homepage" target="_blank">View Code<i class="icon icon-arrow"></i></a>
                        </div>
                    </div>
                    <div class="project-card project-card--2 project-card--complete">
                        <div class="imgtag">
                            <img src="img/js-array.jpg" alt="screenshot of my javascript array website">
                            <p class="tag tag--complete">JAVASCRIPT</p>
                        </div>
                        <div class="content">
                            <h2>Javascript Array -<br>Random Image Generator</h2>
                            <a href="https://js-array.max-seaman.netmatters-scs.co.uk/" target="_blank">View Project <i class="icon icon-arrow"></i></a>
                            <a href="https://github.com/Max-Seaman/JS-Array" target="_blank">View Code<i class="icon icon-arrow"></i></a>
                        </div>
                    </div>
                    <div class="project-card project-card--3 project-card--complete">
                        <div class="imgtag">
                            <img src="img/laravel-project.png" alt="screenshot of my laravel project website">
                            <p class="tag tag--complete">PHP(LARAVEL)</p>
                        </div>
                        <div class="content">
                            <h2>Laravel Admin Project</h2>
                            <a href="https://laravel.max-seaman.netmatters-scs.co.uk/" target="_blank">View Project <i class="icon icon-arrow"></i></a>
                            <a href="https://github.com/Max-Seaman/Admin" target="_blank">View Code<i class="icon icon-arrow"></i></a>
                        </div>
                    </div>
                    <div class="project-card project-card--4 project-card--complete">
                        <div class="imgtag">
                            <img src="img/react-project.jpg" alt="screenshot of my react project website">
                            <p class="tag tag--complete">React</p>
                        </div>
                        <div class="content">
                            <h2>React Shopping List</h2>
                            <a href="https://react.max-seaman.netmatters-scs.co.uk/" target="_blank">View Project <i class="icon icon-arrow"></i></a>
                            <a href="https://github.com/Max-Seaman/React-Shopping-List" target="_blank">View Code<i class="icon icon-arrow"></i></a>
                        </div>
                    </div>
                    <div class="project-card project-card--5 project-card--future">
                        <div class="imgtag">
                            <img src="img/project-stock.jpg" alt="code on computer screen">
                            <p class="tag tag--future">Future</p>
                        </div>
                        <div class="content">
                            <h2>Future Project</h2>
                            <span>Coming Soon</span>
                        </div>
                    </div>
                    <div class="project-card project-card--6 project-card--future">
                        <div class="imgtag">
                            <img src="img/project-stock.jpg" alt="code on computer screen">
                            <p class="tag tag--future">Future</p>
                        </div>
                        <div class="content">
                            <h2>Future Project</h2>
                            <span>Coming Soon</span>
                        </div>
                    </div>
                </div>
            </div>

            <div id="contactform">
                <?php
                // Include DB connection and form functions
                require_once __DIR__ . '/../connect.php';

                $sent = false;
                $errors = [];
                $input = [];

                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $validation = validateForm($_POST);

                    // Additional message length check
                    if (isset($_POST['message']) && strlen(trim($_POST['message'])) < 5) {
                        $validation['valid'] = false;
                        $validation['errors']['message'] = "Message must be at least 5 characters long.";
                    }

                    if ($validation['valid']) {
                        $data = $validation['sanitized'];

                        if (storeContactForm(
                            $data['firstname'],
                            $data['lastname'],
                            $data['email'],
                            $data['telephone'],
                            $data['subject'],
                            $data['message']
                        )) {
                            // DB insert successful
                            // Send email
                            if (sendEmail(
                                $data['firstname'],
                                $data['lastname'],
                                $data['email'],
                                $data['telephone'],
                                $data['subject'],
                                $data['message']
                            )) {
                                $sent = true; // success
                            } else {
                                $errors[] = "Email could not be sent. Please try again later.";
                            }

                            $input = []; // clear form on success
                        } else {
                            $errors[] = "Database insert failed. Please try again later.";
                            $input = $_POST;
                        }
                    } else {
                        $errors = $validation['errors'];
                        $input = $_POST; // preserve inputs
                    }
                    }
                ?>

                <!-- Display success message -->
                <?php if ($sent): ?>
                    <div class="input-control">
                        <div class="form-success">
                            <p>Your message has been sent!</p>
                            <div class="closemessage">&times;</div>
                        </div>
                    </div>
                <?php endif; ?>

                <!-- Display errors -->
                <?php if (!empty($errors)): ?>
                    <div class="input-control">
                        <div class="form-errors">
                            <?php foreach ($errors as $err): ?>
                                <p><?= htmlspecialchars($err) ?></p>
                                <div class="closemessage">&times;</div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endif; ?>
                <div class="form-container">
                    <div class="form__info">
                        <h1>Contact Me</h1>
                        <p>If you have any questions or just want to get in touch, please fill in this form.</p>
                        <div class="form__availability">
                            <h2>Available</h2>
                            <ul>
                                <li>Mon-Fri: 9am - 6pm</li>
                                <li>Sat-Sun: Query for availability</li>
                            </ul>
                        </div>               
                    </div>
                    <div class="form">
                        <p>Please fill in all required (*) fields</p>
                        <form id="form" method="POST" novalidate onsubmit="return validateFormJS()">
                            <div class="input-control">
                                <input type="text" id="firstname" value="<?= htmlspecialchars($input['firstname'] ?? '') ?>" name="firstname" placeholder="First Name*">                 
                            </div>
                            <div class="input-control">
                                <input type="text" id="lastname" value="<?= htmlspecialchars($input['lastname'] ?? '') ?>" name="lastname" placeholder="Last Name*">                       
                            </div>
                            <div class="input-control">
                                <input type="text" id="email" value="<?= htmlspecialchars($input['email'] ?? '') ?>" name="email" placeholder="Email*">                   
                            </div>
                            <div class="input-control">
                                <input type="text" id="telephone" value="<?= htmlspecialchars($input['telephone'] ?? '') ?>" name="telephone" placeholder="Telephone"> 
                            </div>
                            <div class="input-control">
                                <input type="text" id="subject" value="<?= htmlspecialchars($input['subject'] ?? '') ?>" name="subject" placeholder="Subject*"> 
                            </div>
                            <div class="input-control">
                                <textarea id="message" name="message" rows="5" placeholder="Message*"><?= htmlspecialchars($input['message'] ?? '') ?></textarea>  
                            </div>
                            <button id="submit" type="submit">Submit</button>
                        </form>
                    </div>
                </div>
            </div>

            <?php require 'views/layout/footer.php'; ?>
            <?php if ($_SERVER['REQUEST_METHOD'] === 'POST'): ?>
                <script>
                    document.addEventListener('DOMContentLoaded', function(){
                        var form = document.getElementById('contactform');
                        if (form) {
                            form.scrollIntoView({behavior: 'auto', block: 'start'});
                        }
                    });
                </script>
            <?php endif; ?>
        </div>
        <script src="javascript/typing.js"></script>
        <script src="javascript/blossom.js"></script>
        <script src="javascript/transitions.js"></script>
        <script src="javascript/validate.js"></script>
        <script src="javascript/messageremove.js"></script>
    </body>
</html>