<!DOCTYPE HTML>
<HTML>
<head>
<title>MeTube</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>

<?php
    session_save_path("./session");
    session_start();

    include_once("functions/account_functions.php");
    include_once("functions/category_functions.php");

$catName = $_REQUEST['name'];
?>

<!-- Include same header across website -->
<?php
    include('header.php');
?>

<?php
//  Get Category
$result = get_all_media_from_category($catName);
?>

<h1 class="text-center jumbotron mx-auto"> <?php echo $catName;?> </h1>

<?php
    include("display_all_playlist.php");

?>


<!-- Include same footer across website -->
<?php
    include('footer.php');
?>
</body>
</HTML>
