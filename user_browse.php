<!DOCTYPE html>
<?php
	include_once "function.php";
?>

<!-- Query media -->
<?php
    $username = $_GET['username'];

    $query = "SELECT * from media where username = '" .$username ."'"; 
    $result = mysql_query( $query );
    if (!$result){
       die ("Could not query the media table in the database: <br />". mysql_error());
    }
?>
    
<?php include('display_media.php');?>
