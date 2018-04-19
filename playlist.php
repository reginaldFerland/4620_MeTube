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
    include_once("functions/playlist_functions.php");

$playlistID = $_REQUEST['id'];
?>

<!-- Include same header across website -->
<?php
    include('header.php');
?>

<?php
//  Get playlists
$playlist_info = get_playlist_info($playlistID);
?>

<h1 class="text-center jumbotron mx-auto"> <?php echo $playlist_info['name'];?> </h1>

<?php
    // Get most viewed from each
    $result = get_media_from_playlist($playlistID);
    include("display_all_playlist.php");

?>


<!-- Include same footer across website -->
<?php
    include('footer.php');
?>
</body>
</HTML>
