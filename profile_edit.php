<?php
session_save_path("./session");
session_start(); 
include_once('functions/account_functions.php');
include_once('functions/media_functions.php');
$username = $_SESSION['username'];

if(!user_exists($username))
    header("Location: index.php");

#Variables
$user_info = get_user_info($username);
$name = $user_info["name"];
if($name == "NULL") {
    $name = "Name";
}
$email = $user_info["email"];
$about = $user_info["about"];
if(empty($about) or is_null($about) or !isset($about)) {
    $about = "An empty about section!";
}
$join_date = $user_info["join_date"];
$uploads = $user_info["upload"];
$profile_pic = $user_info["mediaID"];

#Profile Picture
$profile_info = get_media_info($profile_pic);
$profile_url = $profile_info["path"];

?>

<head>
<title>Update Profile</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>

<?php include('header.php');?>


<div class="col-sm-4 mx-auto" style="margin:20px">
<form action="update_profile.php" method="post" class="mx-auto form-group">
    <div class="form-group">
        PictureID
        <input type="text" name="profile" placeholder="pictureID, default 1">
    </div>
    <div class="form-group">
        <label> Name </label>
        <input type="text" name="name" placeholder="<?php echo $name;?>">
    </div>
    <div class="form-group">
        <label> Email </label>
        <input type="text" name="email" placeholder="<?php echo $email;?>">
    </div>
    <div class="form-group">
        <label> About </label>
        <textarea type="text" name="about" placeholder="<?php echo $about;?>"></textarea>
    </div>
    <div class="form-group">
        <label> New Password </label>
        <input  type="password" name="passowrd1" placeholder="New Password">
    </div>
    <div class="form-group">
        <label> Repeat New Password </label>
        <input  type="password" name="passowrd2" placeholder="Repeat New Password">
    </div>
    <div class="form-group">
        <label> Current Password </label>
        <input  type="password" name="password" placeholder="Current Password">
    </div>
    <div class="form-group">
        <input name="submit" type="submit" value="Submit">
    </div>
</form>
</div>

<?php include('footer.php');?>
