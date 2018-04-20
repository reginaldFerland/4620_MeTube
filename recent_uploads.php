<!DOCTYPE HTML>
<HTML>
<head>
<title>Recent Uploads</title>
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

<h1 class="text-center jumbotron mx-auto"> Recent Uploads</h1>


<?php
    $result = get_recent_uploads();
    include("display_media.php");
?>


<!-- Include same footer across website -->
<?php
    include('footer.php');
?>
</body>
</HTML>
