<?php
session_save_path("./session");
session_start();
include_once "functions/playlist_functions.php";

$playlistID = $_REQUEST['playlist'];
$mediaID = $_REQUEST['id'];

add_media_playlist($playlistID, $mediaID);

header("Location: ./playlist.php?id=$playlistID");
?>
