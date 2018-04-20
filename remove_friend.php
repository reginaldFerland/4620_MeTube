<?php
include_once("functions/contact_functions.php");

$user = $_REQUEST['user'];
remove_friend($user,$_REQUEST['friend']);

header("Location: ./friends.php");
?>
