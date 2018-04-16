<!DOCTYPE html>
<?php
    include_once "function.php";
?>

<!-- Query media - Most Viewed-->
<?php
    $username = $_GET['username'];

    $query = "SELECT * from Media INNER JOIN Upload on Upload.mediaID = Media.mediaID where Upload.username = '" .$username ."'"; #ORDER BY viewcount DESC LIMIT 5"; 
    $result = mysql_query( $query );
    if (!$result){
       die ("Could not query the media table in the database: <br />". mysql_error());
    }
?>
    
<?php include('display_media.php');?>
