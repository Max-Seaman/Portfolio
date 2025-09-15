<?php 

require_once realpath(__DIR__ . "/../vendor/autoload.php");
use Dotenv\Dotenv;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

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
    echo "Database connection failed<br>  dbvalidate.php:26 - connect.php:30";
    echo $e->getMessage();
    exit;
}

//validate form before storing in db
function validateForm($data) {
    $errors = [];

    // Collect and sanitize
    $firstname  = trim($data['firstname'] ?? '');
    $lastname   = trim($data['lastname'] ?? '');
    $email      = trim($data['email'] ?? '');
    $telephone  = trim($data['telephone'] ?? '');
    $subject    = trim($data['subject'] ?? '');
    $message    = trim($data['message'] ?? '');

    // Validation rules
    if ($firstname === '') {
        $errors['firstname'] = "First name is required.";
    }

    if ($lastname === '') {
        $errors['lastname'] = "Last name is required.";
    }

    if ($email === '') {
        $errors['email'] = "Email is required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Please enter a valid email address.";
    }

    if ($telephone !== '' && !preg_match('/^\+?\d(?:\d|\s){6,15}$/', $telephone)) {
        $errors['telephone'] = "Please enter a valid telephone number.";
    }

    if ($subject === '') {
        $errors['subject'] = "Subject is required.";
    }

    if ($message === '') {
        $errors['message'] = "Message is required.";
    }

    // Return everything together
    return [
        'valid'     => empty($errors),
        'errors'    => $errors,
        'sanitized' => [
            'firstname' => $firstname,
            'lastname'  => $lastname,
            'email'     => $email,
            'telephone' => $telephone,
            'subject'   => $subject,
            'message'   => $message,
        ]
    ];
}

// Store contact form response in db
function storeContactForm($firstname, $lastname, $email, $telephone, $subject, $message) {
    global $db;

    try {
        $sql = $db->prepare("
            INSERT INTO contactform (firstname, lastname, email, telephone, subject, message) 
            VALUES (:firstname, :lastname, :email, :telephone, :subject, :message)
        ");

        $sql->execute([
            ':firstname'      => $firstname,
            ':lastname'   => $lastname,
            ':email'     => $email,
            ':telephone' => $telephone === '' ? null : $telephone,
            ':subject'   => $subject,
            ':message'   => $message
        ]);

        return true; // success
    } catch (PDOException $e) {
        error_log("DB insert failed: " . $e->getMessage()); // Log error for debugging
        return false; // failure
    }
}

// sending email function
function sendEmail($firstname, $lastname, $email, $telephone, $subject, $message) {
    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host = $_ENV["MAIL_HOST"];
        $mail->SMTPAuth = true;
        $mail->Username = $_ENV["MAIL_USERNAME"];
        $mail->Password = $_ENV["MAIL_PASSWORD"];
        $mail->SMTPSecure = 'tls';
        $mail->Port = $_ENV["MAIL_PORT"];

        $mail->setFrom($_ENV["MAIL_FROM"], "Portfolio");
        $mail->addAddress($_ENV["MAIL_TO"]);

        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body = "Name: " . $firstname . " " . $lastname . "<br>" . "Email: " . $email . "<br>" . "Telephone: " . $telephone . "<br>" . "Subject: " . $subject . "<br>" . "Message: " . $message;

        $mail->send();
        return True;
    } catch (Exception $e) {
        echo $e->getMessage();
        return False;
    }
}