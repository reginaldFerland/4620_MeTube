<?php
include_once("functions/contact_functions.php");

$user = $_REQUEST['user'];
add_friend($user,$_REQUEST['friend']);


header("Location: profile.php?username=$user");
?>
