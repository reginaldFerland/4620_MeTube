<!doctype html>
<!-- For login management -->
<?php 
session_save_path("/home/rferlan/public_html/metube/session");
session_start(); 
include_once("function.php");
# Check if user is viewing own page
if($_SESSION['username'] == $_GET['username']){
    $self = True;
}
else {
    $self = False;
}

# Check that this is valid user page
$username = $_GET['username'];
$query = "SELECT * from account where username = '" .$username . "'";
$result = mysql_query($query);
$result_row = mysql_fetch_assoc($result);
if (mysql_num_rows($result) == 0) {
    header("Location: index.php");
}

#Variables
$fname = $result_row["fname"];
$lname = $result_row["lname"];
$email = $result_row["email"];
$about = $result_row["about"];
$join_date = $result_row["join_date"];
$uploads = $result_row["uploads"];
$profile_pic = $result_row["mediaID"];

#Profile Picture
$query = "SELECT * from media where mediaID = '" .$profile_pic ."'";
$profile_result = mysql_query($query);
$profile_row = mysql_fetch_assoc($profile_result);
$profile_url = $profile_row["path"];


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
            <p><?php echo $fname . " " . $lname;?></p>
            <!-- User Join Date -->
            <p>Joined on <?php echo $join_date;?>.</p>
            <p><?php echo $username;?> has uploaded <?php echo $uploads;?> files.</p>
        </div>
    </div>
    <?php if($self) {?> <div class="btn-group"> <a href="./profile_edit" class="btn btn-primary active">Edit</a> </div><?php }?>
</div>

<!-- Browse uploaded files -->
<?php include('user_browse.php');?>

<!-- Footer -->
<?php include('footer.php'); ?>
</body>
</html>
