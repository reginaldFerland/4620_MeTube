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
    include_once("functions/category_functions.php")

?>

<h1 class="text-center jumbotron mx-auto"> CATEGORIES </h1>

<h1 class="text-center"> Comedy </h1>

<?php
    $result = get_all_media_from_category("comedy");
    {
        $LIMIT = 5;
        include("display_category.php");
    }   
?>

<h1 class="text-center"> Education </h1>

<?php
    $result = get_all_media_from_category("education");
    {
        $LIMIT = 5;
        include("display_category.php");
    }   
?>


<h1 class="text-center"> Gaming </h1>

<?php
    $result = get_all_media_from_category("gaming");
    {
        $LIMIT = 5;
        include("display_category.php");
    }   
?>


<h1 class="text-center"> Nature </h1>

<?php
    $result = get_all_media_from_category("nature");
    {
        $LIMIT = 5;
        include("display_category.php");
    }   
?>

<h1 class="text-center"> Music </h1>

<?php
    $result = get_all_media_from_category("music");
    {
        $LIMIT = 5;
        include("display_category.php");
    }   
?>

<?php include("footer.php");?>
</body>
</HTML>
