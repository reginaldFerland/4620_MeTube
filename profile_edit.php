<?php
session_save_path("/home/rferlan/public_html/metube/session");
session_start(); 
include_once('function.php');
$username = $_SESSION['username'];

$query = "SELECT * from account where username = '" .$username . "'";
$result = mysql_query($query);
$result_row = mysql_fetch_assoc($result);
if (mysql_num_rows($result) == 0) {
    header("Location: index.php");
}

#Variables
$fname = $result_row["fname"];
if($fname == "NULL") {
    $fname = "First Name";
}
$lname = $result_row["lname"];
if($lname == "NULL") {
    $lname = "Last Name";
}
$email = $result_row["email"];
$about = $result_row["about"];
if(empty($about) or is_null($about) or !isset($about)) {
    $about = "An empty about section!";
}
$join_date = $result_row["join_date"];
$uploads = $result_row["uploads"];
$profile_pic = $result_row["mediaID"];

#Profile Picture
$query = "SELECT * from media where mediaID = '" .$profile_pic ."'";
$profile_result = mysql_query($query);
$profile_row = mysql_fetch_assoc($profile_result);
$profile_url = $profile_row["path"];

?>

<head>
<title>Update Profile</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>

<?php include('header.php');?>

<form action="update_profile.php" method="post" style="max-width:200px; margin: 20px" class="mx-auto">
    <div class="form-group">
        <input type="text" name="profile" placeholder="pictureID, default 0">
    </div>
    <div class="form-group">
        <input type="text" name="fname" placeholder="<?php echo $fname;?>">
    </div>
    <div class="form-group">
        <input type="text" name="lname" placeholder="<?php echo $lname;?>">
    </div>
    <div class="form-group">
        <input type="text" name="email" placeholder="<?php echo $email;?>">
    </div>
    <div class="form-group">
        <textarea type="text" name="about" placeholder="<?php echo $about;?>"></textarea>
    </div>
    <div class="form-group">
        <input  type="password" name="passowrd1" placeholder="New Password">
    </div>
    <div class="form-group">
        <input  type="password" name="passowrd2" placeholder="Repeat New Password">
    </div>
    <div class="form-group">
        <input  type="password" name="password" placeholder="Current Password">
    </div>
    <div class="form-group">
        <input name="submit" type="submit" value="Submit">
    </div>
</form>


<?php include('footer.php');?>
