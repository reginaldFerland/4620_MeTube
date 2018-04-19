<?php
session_save_path("./session");
session_start();
include_once "functions/account_functions.php";
include_once "functions/category_functions.php";
include_once "functions/playlist_functions.php";

// Parse data
$playlist_name = $_POST["name"];
$description = $_POST["description"];
$id = $_SESSION['add_video'];
unset($_SESSION['add_video']);
$user = $_SESSION['username'];

// Attempt to create playlist
$playlistID = create_playlist($user, $playlist_name, $description);
if($playlistID > 0)
{
    // Upload categories
    if(isset($_POST["comedy"]))
        add_playlist_category($playlistID, "comedy");
    if(isset($_POST["education"]))
        add_playlist_category($playlistID, "education");
    if(isset($_POST["gaming"]))
        add_playlist_category($playlistID, "gaming");
    if(isset($_POST["nature"]))
        add_playlist_category($playlistID, "nature");
    if(isset($_POST["music"]))
        add_playlist_category($playlistID, "music");
 
    // call add_to_playlist
    header("Location: ./add_to_playlist.php?playlist=$playlistID&id=$id");
}
else
{
// If ERROR, process

// Forward to playlists

}

?>
