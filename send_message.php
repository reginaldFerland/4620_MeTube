<?php
session_save_path("./session");
session_start();

$reciever = $_REQUEST['reciever'];
$message = $_REQUEST['message'];
unset($_SESSION['receiver']);

include_once("functions/message_functions.php");

$result = send_message($_SESSION['username'], $reciever, $message);

header("Location: ./message.php?friend=$reciever");
?>
