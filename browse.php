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

<!-- Query media - MOST VIEWS-->
<h1 class="text-center"><a href="./most_viewed.php">Most Viewed</a></h1>
<?php

    $query = "SELECT * from Media INNER JOIN Upload ON Upload.mediaID = Media.mediaID where (public = TRUE) ORDER BY viewcount DESC LIMIT 4"; 
    $result = mysql_query( $query );
    if (!$result){
       die ("Could not query the media table in the database: <br />". mysql_error());
    }

?>

<?php include('display_media.php');?>

<!-- Query media - NEWEST-->
<h1 class="text-center"><a href="./recent_uploads.php" >Recent Uploads</a></h1>
<?php

    $query = "SELECT * from Media INNER JOIN Upload ON Upload.mediaID = Media.mediaID where public = TRUE ORDER BY upload_time DESC LIMIT 4"; 
    $result = mysql_query( $query );
    if (!$result){
       die ("Could not query the media table in the database: <br />". mysql_error());
    }

?>

<?php include('display_media.php');?>

<!-- Query media - Recently Viewed-->
<h1 class="text-center"><a href="./recently_viewed.php">Recently Viewed</a></h1>
<?php

    $query = "SELECT * from Media INNER JOIN Upload ON Upload.mediaID = Media.mediaID where public = TRUE ORDER BY last_access DESC LIMIT 4"; 
    $result = mysql_query( $query );
    if (!$result){
       die ("Could not query the media table in the database: <br />". mysql_error());
    }

?>

<?php include('display_media.php');?>


