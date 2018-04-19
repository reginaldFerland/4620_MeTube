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

    $username = $_SESSION['username'];

    if(!user_exists($username))
        header("Location: index.php");
?>

<!-- Include same header across website -->
<?php
    include('header.php');
?>

<h1 class="text-center jumbotron mx-auto"> My Playlists </h1>

<?php
//  Get user playlists
$user_playlists = get_user_playlists($username);

// Loop
while($playlist = mysql_fetch_assoc($user_playlists))
{
?>
    <h1 class="text-center mx-auto">
        <a href="./playlist.php?name=<?php echo $playlist['name'];?>"><?php echo $playlist['name'];?></a>
    </h1>

<?php
    // Get 5 most viewed from each
    $result = get_media_from_playlist($playlist['playlistID']);
    $LIMIT = 5;    
    include("display_playlist.php");
}
?>







<!-- Include same footer across website -->
<?php
    include('footer.php');
?>
</body>
</HTML>
