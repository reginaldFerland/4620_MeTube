<!doctype html>
<html>
<head>
<title>Add to Playlist</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>

<?php
    session_save_path("./session");
    session_start();
    include_once('functions/playlist_functions.php');
    include_once('functions/account_functions.php');

    $username = $_SESSION['username'];
    $mediaID = $_REQUEST['id'];

    if(!user_exists($username))
        header("Location: index.php");


?>

<!-- Include same header across website -->
<?php
    include('header.php');
?>

<h1 class="text-center jumbotron mx-auto"> Add to Playlist </h1>

<?php
//  Get user playlists
$user_playlists = get_user_playlists($username);
?>

    <!-- OFFER NEW PLAYLIST -->
    <h1 class="text-center mx-auto">
        <a href="./create_playlist.php?id=<?php echo $mediaID;?>">Create New Playlist</a>
    </h1>


<?php
// Loop
while($playlist = mysql_fetch_assoc($user_playlists))
{
?>
    <h1 class="text-center mx-auto">
        <a href="./add_to_playlist.php?playlist=<?php echo $playlist['playlistID'];?>&id=<?php echo $mediaID;?>"><?php echo $playlist['name'];?></a>
    </h1>

<?php } ?>

<!-- Include same footer across website -->
<?php
    include('footer.php');
?>
</body>
</html>
