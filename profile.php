<!doctype html>
<!-- For login management -->
<?php 
session_save_path("/home/rferlan/public_html/metube/session");
session_start(); 
#include_once("function.php");
include_once("functions/account_functions.php");
include_once("functions/media_functions.php");
# Check if user is viewing own page
if($_SESSION['username'] == $_GET['username']){
    $self = True;
}
else {
    $self = False;
}

# Check that this is valid user page
$username = $_GET['username'];
if(!user_exists($username))
    header("Location: index.php");

$user_info = get_user_info($username);

#Variables
$name = $user_info["name"];
$email = $user_info["email"];
$about = $user_info["about"];
if(empty($about) or is_null($about) or !isset($about)) {
    $about = "An empty about section!";
}
$join_date = $user_info["join_date"];
$uploads = $user_info["upload"];
$profile_pic = $user_info["mediaID"];
if($profile_pic == NULL)
    $profile_pic = 1;

#Profile Picture
$profile_info = get_media_info($profile_pic);
$profile_url = $profile_info["path"];


?>

<html>
<head>
<!-- Use php to create title -->
<title> <?php echo $username ?>'s Profile </title>

<!-- Add css sheet -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">

</head>
<body>
<!-- Header -->
<?php include('header.php'); ?>

<!-- Top Row -->
<div class="row">
    <!-- Picture goes here -->
    <div class="media">
        <div class="media-left">
            <img class="img-thumbnail" src="<?php echo $profile_url;?>" width="250">
        </div>

        <div class="media-body">
            <!-- Title row -->
            <h4 class="media-heading">Welcome to <?php echo $username?>'s page</h4>
            <!-- Real Name goes here -->
            <p><?php if($name != "NULL") { echo $name;}?> 
            <!-- User Join Date -->
            Joined on <?php echo $join_date;?>. 
            <?php echo $username;?> has uploaded <?php echo $uploads;?> files.</p>
            <!-- About section -->
            <p><?php echo $about;?></p>
        </div>
        <div class="media-right mx-auto">
            <h4 class=media-heading"><?php echo $username;?>'s Friends</h4>
            <?php
                $query = "SELECT * from Contact where username='$username' LIMIT 5";
                $results = mysql_query($query);
                while ($results_row = mysql_fetch_assoc($results)) { $friend = $results_row['friend']; ?>
                    <p><a href="./profile.php?username=<?php echo $friend;?>"><?php echo $friend;?></a></p>
            <?php }?>
        </div>
    </div>
    <?php if($self) {?> <div> <a href="./profile_edit.php" class="btn btn-primary active">Edit</a> </div><?php }
    else { ?>
        <div> <a href="./add_friend.php?user=<?php echo $_SESSION['username'];?>&friend=<?php echo $username;?>" class="btn-primary active">Add Friend</a> </div>
    <?php } ?>
</div>

<!-- Browse uploaded files -->
<?php include('user_browse.php');?>

<!-- Footer -->
<?php include('footer.php'); ?>
</body>
</html>
