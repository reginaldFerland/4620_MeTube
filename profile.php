<!doctype html>
<!-- For login management -->
<?php 
session_save_path("./session");
session_start(); 
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

<h1 class="jumbotron mx-auto text-center">Welcome to <?php echo $username?>'s page</h1>

<!-- Top Row -->
<div class="row">
    <!--Profile Pic-->
    <div class="col-4 text-center">
        <img class="mx-auto img-thumbnail" style="width:250px;height:250px" src="<?php echo $profile_url;?>" alt="Profile Picture">

    </div>
    <!-- About area -->
    <div class="col-4 text-center">
        <h2 class=""><b><?php echo $name?></b></h2>
        <p class="">Joined: <?php echo substr($join_date,0,10);?></p>
        <p class=""><?php echo $about;?></p>
    </div>
    <!-- Buttons -->
    <div class="col-3 text-right">

    <?php 
        if($self) {?> 
            <div> <a href="./profile_edit.php" class="btn btn-primary active">Edit</a> </div>
        <?php }
        else { ?>
            <div> 
                <a href="./add_friend.php?user=<?php echo $_SESSION['username'];?>&friend=<?php echo $username;?>" class="btn-primary active">Add Friend</a> 
            </div>
        <?php } ?>
    </div>
</div>

<h1 class="mx-auto text-center"><?php echo $username;?> has uploaded <?php echo $uploads;?> files!</h1>

<!-- Browse uploaded files -->
<?php include('user_browse.php');?>

<!-- Footer -->
<?php include('footer.php'); ?>
</body>
</html>
