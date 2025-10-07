<?php

require 'views/layout/head.php';

require 'views/layout/sidebar.php';

?>

        <div id="main-content">

            <div class="coding-examples">
                <h1>< Coding Examples ></h1>

                <div class="example">
                    <h2>Netmatters Homepage Recreation</h2>
                    <h3>PHP Database Connection</h3>
                    <p>From my recreaion of the <a href="https://netmatters.max-seaman.netmatters-scs.co.uk/" class="link">Netmatters</a> website project. Made during my time on the Netmatters SCS course.</p>
                    <pre><code class="language-php">
require_once realpath(__DIR__ . "/../vendor/autoload.php");
use Dotenv\Dotenv;

// Load .env
$dotenv = Dotenv::createImmutable(__DIR__ . "/../");
$dotenv->load();

// DB credentials from .env
$username = $_ENV["DB_USER"];
$password = $_ENV["DB_PASSWORD"];
$host = $_ENV["DB_HOST"];
$database = $_ENV["DB_NAME"];
$charset = "utf8mb4";

$dsn = "mysql:host=$host;dbname=$database;charset=$charset";


// Connection to db for contact form
try {
    $db = new PDO($dsn, $username, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);
} catch (Exception $e) {
    echo "Database connection failed - coding-examples.php:43";
    echo $e->getMessage();
    exit;
}
                    </code></pre>
                    <p>For this I added an env file using a Composer package. I did this so the database credentials are not stored in any file the user has access to. This then reduces the risk of a malicious attack. Then use try-catch a statement to link to the database.</p>
                    <pre><code class="language-php">
function storeContactForm($name, $company, $email, $phone, $message, $marketing) {
    global $db;

    try {
        $sql = $db->prepare("
            INSERT INTO contactform (name, companyname, email, phone, message, marketing) 
            VALUES (:name, :company, :email, :phone, :message, :marketing)
        ");

        $sql->execute([
            ':name'      => $name,
            ':company'   => $company,
            ':email'     => $email,
            ':phone'     => $phone,
            ':message'   => $message,
            ':marketing' => $marketing
        ]);

        return true; // success
    } catch (PDOException $e) {
        error_log("DB insert failed: " . $e->getMessage()); // Log error for debugging
        return false; // failure
    }
}
                    </code></pre>
                    <p>This function is called in the contact form page to store the submitted form data into the database. It uses a prepared statement to prevent SQL injection attacks and ensure data integrity.</p>
                </div>

                <div class="example">
                    <h2>My Portfolio</h2>
                    <h3>Javascript Petal Blossom</h3>
                    <p>From the hero image on the main page of my Portfolio. Researched and made myself to add an immediate eye-catching piece for viewers as soon as my Portfolio is opened. Made during my time on the Netmatters SCS course.</p>
                    <pre><code class="language-js">
// Load image
const petalImage = new Image();
petalImage.src = 'javascript/img/petal.png';

class Petal {
    constructor() {
        // Starting position in the top right quandrant 
        this.x = Math.random() * (canvas.width * 0.5) + canvas.width * 0.5;  // 50% to 100% width
        this.y = Math.random() * (canvas.height * 0.5);  // 0 to 50% height
        // Petal size
        this.size = Math.random() * 35 + 25;  // size in pixels
        // Fall speed
        this.speedX = -(Math.random() + 0.2);  // negative for moving left
        this.speedY = Math.random() + 0.5;  // positive for moving down
        // Rotation of petal while falling
        this.rotation = Math.random() * 360;
        this.rotationSpeed = (Math.random() - 0.5) * 2;
    }

    update() {
        // Updating the petal positions based on its speed
        this.x += this.speedX;
        this.y += this.speedY;
        // Updating the petal rotation angle based on its rotation speed
        this.rotation += this.rotationSpeed;

        // Resets and gives a new start position for petals fallen out of frame 
        if (this.y > canvas.height || this.x + this.size < 0) {
            this.x = Math.random() * (canvas.width * 0.5) + canvas.width * 0.5; 
            this.y = Math.random() * (canvas.height * 0.5); 
        }
    }

    draw(context) {
        // Save and Restore to ensure each petal can rotate and move independantly
        context.save();
        // Starting points
        context.translate(this.x, this.y);
        // Rotate petals
        context.rotate(this.rotation * Math.PI / 180); // change to degrees rather than radians
        // 3D-like rotation
        const flutter = Math.cos(this.rotation * Math.PI / 90);  // last number alters the speed of 'flip'
        context.scale(flutter, 1); // Horizontal flip and squish/stretch
        // Draw the petal
        context.drawImage(petalImage, -this.size / 2, -this.size / 2, this.size, this.size);
        context.restore();
    }
}
                    </code></pre>
                    <p>When the image is loaded, an array of Petal objects is created. Each petal has random properties for position, size, speed, and rotation. Each petal starts in the top right of the image and falls until off-screen where it's removed and a new one is added.</p>
                    <pre><code class="language-js">
// When the image is loaded
petalImage.onload = () => {
    // Empty array for the petals
    const petals = [];

    // Creating a certain number of petals (30 in my case)
    for (let i = 0; i < 30; i++) {
        petals.push(new Petal());
    }

    function animate() {
        // Make sure they don't leave any trails behind
        // Each frame is drawn fresh, allowing objects like petals to move smoothly without leaving marks behind
        context.clearRect(0, 0, canvas.width, canvas.height);  
        for (let petal of petals) {
            petal.update();
            petal.draw(context);
        };
        requestAnimationFrame(animate); //Ensures smooth animation
    }

    animate();  // only start after image loads
}
                    </code></pre>
                    <p>This code handles the animation loop. It continuously updates and redraws each petal on the canvas, creating a smooth falling effect. The canvas is cleared each frame to prevent trails, and requestAnimationFrame is used for efficient animation timing.</p>
                </div> 
                
                <div class="example">
                    <h2>Javascript Image Generator</h2>
                    <h3>Preloading Next Image</h3>
                    <p>From my <a href="https://js-array.max-seaman.netmatters-scs.co.uk/" class="link">JS Array</a> project. Made during my time on the Netmatters SCS course.</p>
                    <pre><code class="language-js">
let loading = false;
let nextImage = null;

async function loadRandomImage() {
    if (loading) {
        return
    }
    
    loading = true;
    const btn = document.getElementById("new-image");
    btn.disabled = true; // disable button
    
    $(".loader").show(); // show loader
    $(".container-image img").remove(); // remove old image

    try {
        let img;

        // Use preloaded image if available
        if (nextImage) {
            img = nextImage;
            nextImage = null;
        } else {
            img = await createImage();
        }

        // Add image to page
        $(".container-image").append(img);

        // Start preloading the next image
        preloadNextImage();
    } catch (error) {
        console.error("Image failed to load", error);
        showMessage("error", "Failed to load random image. Please refresh and try again.");
    } finally {
        $(".loader").hide(); // always hide loader
        btn.disabled = false;  // unlock button
        loading = false;
    }
}
                    </code></pre>
                    
                </div>

                <div class="example">
                    <h2>Laravel Admin Management System</h2>
                    <h3>Company Creation with Validation & Logo Upload</h3>
                    <p>From my <a href="https://laravel.max-seaman.netmatters-scs.co.uk/" class="link">Laravel Company Management</a> project, built as part of the Netmatters SCS course. This function handles new company creation — validating inputs, managing image uploads, and ensuring each company entry has a stored or default logo.</p>
                    <pre><code class="language-php">
public function store(Request $request)
{
    //validation
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'website' => 'nullable|url',
        'logo' => 'nullable|image|mimes:jpg,jpeg,png,gif,svg|max:2048|dimensions:min_width=100,min_height=100',
    ]);

    // Handle logo upload or default
    if ($request->hasFile('logo')) {
        $logo = $request->file('logo');

        // Generate unique file name
        $filename = time() . '_' . $logo->getClientOriginalName();

        // Move the file to public/img folder
        $logo->move(public_path('img'), $filename);

        $validated['logo'] = 'img/' . $filename;
    } else {
        // Default logo in public/img
        $validated['logo'] = 'img/default-company.png';
    }

    //create
    Company::create($validated);

    return redirect('/companies');
}
                    </code></pre>
                    <p>  
                        This begins by validating incoming form data to ensure each field meets the required format and type — for example, enforcing a valid email and checking that uploaded logos meet minimum size and format requirements.
                    </p>
                    <p>
                        If a logo is provided, the function renames the file with a timestamp to prevent filename conflicts, then moves it into the public/img directory so it can be accessed directly by the web server.
                    </p>
                    <p>
                        If no logo is uploaded, a default image path is assigned to maintain visual consistency across company records.
                    </p>
                    <p>    
                        Finally, the validated data is passed to Laravel&apos;s Eloquent ORM, which automatically inserts the new record into the database and redirects the user to the company listing page, where the application retrieves and displays the updated list including the newly created company.
                    </p>
                </div>
            </div>

            <?php require "views/layout/footer.php"; ?>
        </div>
        <script src="../javascript/transitions.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/components/prism-core.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/plugins/autoloader/prism-autoloader.min.js"></script>
    </body>
</html>