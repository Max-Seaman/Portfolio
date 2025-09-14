<?php

// Define routes in one place
$routes = [
    "/" => [
        "title" => "Portfolio | Max Seaman",
        "view"  => "index.php"
    ],
    "/about-me" => [
        "title" => "About Me",
        "view"  => "about-me.php"
    ],
    "/coding-examples" => [
        "title" => "Coding Examples",
        "view"  => "coding-examples.php"
    ],
    "/scs-scheme" => [
        "title" => "Scion Coalition Scheme",
        "view"  => "scs-scheme.php"
    ]
];

// Get current URI
$uri = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);

// Check if route exists
if (array_key_exists($uri, $routes)) {
    $title = $routes[$uri]["title"];
    require "views/pages/" . $routes[$uri]["view"];
}  

