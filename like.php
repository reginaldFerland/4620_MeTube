<?php
include_once("functions/media_functions.php");
session_save_path("./session");
session_start();
 

$id = urlencode($_GET['id']);

add_like($id);

header("Location: ./media.php?id=$id");
?>
