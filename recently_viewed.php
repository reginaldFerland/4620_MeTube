<!DOCTYPE HTML>
<HTML>
<head>
<title>Recently Viewed</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>

<?php
    session_save_path("./session");
    session_start();

    include_once("mysqlClass.inc.php");
    include_once("functions/media_functions.php");
?>

<!-- Include same header across website -->
<?php
    include('header.php');
?>

<?php
//  Get Category
?>

<h1 class="text-center jumbotron mx-auto"> Recently Viewed </h1>


<?php
    $result = get_recent_viewed();
    include("display_media.php");
?>


<!-- Include same footer across website -->
<?php
    include('footer.php');
?>
</body>
</HTML>
