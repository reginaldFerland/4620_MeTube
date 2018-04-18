<!DOCTYPE HTML>
<?php
    session_save_path("./session");
    session_start();
    include_once("mysqlClass.inc.php");
    include_once("functions/media_functions.php");
    include_once("functions/comments_functions.php");
    include_once("functions/account_functions.php");
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
    $id = $_GET['id'];
    $media_info = get_media_info($id);
    $name = $media_info['name'];
    $filepath = $media_info['path']; 
    $type = $media_info['type'];
    $views = $media_info['viewcount'];
    $description = $media_info['description'];
    if($description == NULL)
        $description = "No description";
    $user = $media_info['username'];
    $upload_time = $media_info['upload_time'];
    $likes = $media_info['likes'];

    // Type info
    if(substr($type,0,5)=="image")
        $is_image = True;
    else
        $is_image = False;

    $_SESSION['viewing'] = $id;
    
    increment_views($id);
    update_media_timestamp($id);
?>

    <h1 class="text-center"> <?php echo $name;?></h1>
    <h5 class="text-center"> Uploaded by: 
        <a class="" href="./profile.php?username=<?php echo $user;?>"><?php echo $user;?></a>
    </h5>

    <div class="row">
<?php
    if($is_image) //view image
    {
?>
        <img class="mx-auto" src="<?php echo $filepath;?>"/>
<?php
    }
    else //view movie
    {   
?>
        <video controls><source src="<?php echo $filepath;?>" type="<?php echo $type;?>"> </video>        
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
    </div>
    <div class="row">
        <p class="mx-auto">Views: <?php echo $views;?>
        <a class="text-center" href="<?php echo $filepath;?>" target="_blank" download >Download</a>
        <a class="" href="./like.php?id=<?php echo $id;?>">Likes</a>: <?php echo $likes;?>
        </p>
    </div>
    <div class="row">
        <h5 class="text-center mx-auto"> Description </h5>
    </div>
    <div class="row">
        <div class="col-sm"></div>
        <div class="col-sm"><p class="text-center"> <?php echo $description;?></p></div>
        <div class="col-sm"></div>
    </div>

<!-- Comment section -->
<hr>
<h5 class="text-center"> Comments </h5>

<div class="container">
<?php
    $comment_results = get_media_comments($id);
    while($comment = mysql_fetch_assoc($comment_results))
    {
    $userinfo = get_user_info($comment['username']);
    $profileID = $userinfo['mediaID'];
    $profile_info = get_media_info($profileID);
    $profile_pic = $profile_info['path'];
?>

<div class="row">
<div class="col-sm-1">
<div class="thumbnail">
<img class="img-responsive user-photo" style="width:50px; height:50px" src="<?php echo $profile_pic;?>">
</div><!-- /thumbnail -->
</div><!-- /col-sm-1 -->

<div class="col-sm-5">
<div class="panel panel-default">
<div class="panel-heading">
<strong><?echo $comment['username'];?></strong> </div>
<div class="panel-body">
<?php echo $comment['comment'];?>
</div><!-- /panel-body -->
</div><!-- /panel panel-default -->
</div><!-- /col-sm -->
</div>

<?php } ?>

<!-- ADD A COMMENT -->
<form class="form-group" action="comment.php" method="POST" enctype="multipart/form-data">
    <textarea name="comment" class="form-control text-center" placeholder="Add your own comment!"></textarea>
    <button class="btn btn-primary mx-auto" type="submit">Add</button>
</form>

<?php
    include('footer.php');
?>
</body>
</html>
