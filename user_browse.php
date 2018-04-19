<!DOCTYPE html>
<?php
    include_once "mysqlClass.inc.php";
?>

<!-- Query media - Most Viewed-->
<?php

    $query = "SELECT * from Media INNER JOIN Upload on Upload.mediaID = Media.mediaID where Upload.username = '$username' ORDER BY viewcount DESC"; 
    $result = mysql_query( $query );
    if (!$result){
       die ("Could not query the media table in the database: <br />". mysql_error());
    }
?>
    
<?php include('display_media.php');?>
