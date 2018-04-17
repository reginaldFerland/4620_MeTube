<!DOCTYPE HTML>
<?php
    session_save_path("./session");
    session_start();
    include_once("mysqlClass.inc.php");
    include_once("functions/media_functions.php");
    include_once("functions/comments_functions.php");
?>  
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Media</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>

<body>
<?php
    include('header.php');
?>
<?php
if(isset($_GET['id'])) {
    $query = "SELECT * FROM Media WHERE mediaID='".$_GET['id']."'";
    $result = mysql_query( $query );
    $result_row = mysql_fetch_assoc($result);
    
    increment_views($_GET['id']);
    update_media_timestamp($_GET['id']);
    $filename=$result_row['name'];   ////0, 4, 2
    $filepath=$result_row['path']; 
    $type=$result_row['type'];
?>
    <a href="<?php echo $result_row['path'];?>" target="_blank" download >Download</a>
<?php
    echo "\n Views:" . $result_row['viewcount'] . " ";

    if(substr($type,0,5)=="image") //view image
    {
        echo "Viewing Picture:";
        echo $result_row['name'];
        echo "<img src='".$filepath."'/>";
        echo $result_row['description'];

    }
    else //view movie
    {   
?>
        <!-- <p>Viewing Video:<?php echo $result_row['type'].$result_row['username'];?></p> -->
        <p>Viewing Video:<?php echo $result_row['path'];?></p>
          
        <video controls><source src="<?php echo $result_row['path']?>" type="<?php echo $result_row['type']?>"> </video>        

              
<?php
    }
}
else
{
?>
    <meta http-equiv="refresh" content="0;url=index.php">
<?php
}
?>

<!-- Comment section -->
<hr>
<h5 class="text-center"> Comments </h5>

<?php
    $comment_results = get_media_comments($_GET['id']);
    while($comment = mysql_fetch_assoc($comment_results))
    {
    echo "Comment #" . $comment['commentID'] . " ";
    echo $comment['username'] . "\t";
    echo $comment['comment'] . "\n";

    }
?>


<?php
    include('footer.php');
?>
</body>
</html>
