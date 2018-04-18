<?php
include_once("functions/media_functions.php");
session_save_path("./session");
session_start();
 

$id = urlencode($_SESSION['viewing']);

add_like($id);

header("Location: ./media.php?id=$id");
?>
