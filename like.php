<?php
include_once("functions/media_functions.php");
include_once("functions/playlist_functions.php");
session_save_path("./session");
session_start();
 

$id = urlencode($_GET['id']);
$favorites = get_favorite_id($_SESSION['username']);

// Add id to favorites list, if successful add like
if(add_media_playlist($favorites, $id) == 1)
    add_like($id);
else
{
    remove_media_playlist($favorites, $id);
    remove_like($id);

}


header("Location: ./media.php?id=$id");
?>
