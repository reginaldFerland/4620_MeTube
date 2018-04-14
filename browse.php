<!DOCTYPE html>
<?php
	include_once "function.php";
?>
<!-- browse categories -->

<div id='upload_result'>
    <?php 
        if(isset($_REQUEST['result']) && $_REQUEST['result']!=0)
        {		
            echo upload_error($_REQUEST['result']);
        }
    ?>
</div>
<br/><br/>
<!-- Query media -->
<?php

    $query = "SELECT * from media where username != 'NULL'"; 
    $result = mysql_query( $query );
    if (!$result){
       die ("Could not query the media table in the database: <br />". mysql_error());
    }

?>

<?php include('display_media.php');?>

