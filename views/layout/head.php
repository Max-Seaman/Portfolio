<!DOCTYPE html>

<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Full-stack web developer specializing in modern, responsive websites and web applications. Explore my work and skills." />
        <meta name="title" content="My web devlopment portfolio" />
        
        <link rel="icon" href="img/favicon-ms.svg">

        <title><?= $title ?></title>
        <?php if ($title === "Coding Examples") { ?>
            <link href="https://cdn.jsdelivr.net/gh/PrismJS/prism-themes@master/themes/prism-gruvbox-dark.min.css" rel="stylesheet">
        <?php } ?>
        <link rel="stylesheet" href="css/fonts.css">
        <link rel="stylesheet" href="css/style.css">
    </head>