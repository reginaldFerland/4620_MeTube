<!DOCTYPE HTML>
<HTML>
<head>
<title>Categories</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>

<?php
    session_save_path("./session");
    session_start();
    include("header.php");
    include_once("functions/category_functions.php");

    $LIMIT = 4;
?>

<h1 class="text-center jumbotron mx-auto"> CATEGORIES </h1>

<h1 class="text-center"><a href="./view_all_category.php?name=comedy"> Comedy </a></h1>

<?php
    $result = get_all_media_from_category("comedy");
    {
        include("display_category.php");
    }   
?>

<h1 class="text-center"> <a href="./view_all_category.php?name=education">Education </a></h1>

<?php
    $result = get_all_media_from_category("education");
    {
        include("display_category.php");
    }   
?>


<h1 class="text-center"> <a href="./view_all_category.php?name=gaming">Gaming </a></h1>

<?php
    $result = get_all_media_from_category("gaming");
    {
        include("display_category.php");
    }   
?>


<h1 class="text-center"><a href="./view_all_category.php?name=nature"> Nature </a></h1>

<?php
    $result = get_all_media_from_category("nature");
    {
        include("display_category.php");
    }   
?>

<h1 class="text-center"><a href="./view_all_category.php?name=music"> Music </a></h1>

<?php
    $result = get_all_media_from_category("music");
    {
        include("display_category.php");
    }   
?>

<?php include("footer.php");?>
</body>
</HTML>
