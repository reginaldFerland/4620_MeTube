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
$about = $result_row["about"];
$join_date = $result_row["join_date"];
$uploads = $result_row["uploads"];
$profile_pic = $result_row["mediaID"];
?>

<html>
<head>
<!-- Use php to create title -->
<title> <?php echo $username ?> </title>

<!-- Add css sheet -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">

</head>
<body>
<!-- Header -->
<?php include('header.php'); ?>

<?php
#Name
    echo "Welcome to <b>" . $username . "'s</b> page!";
    echo "Owned by " . $fname . " " . $lname . ".";
    echo "Member since " . $join_date . "\n";
    echo "Uploaded " . $uploads . " images/videos ";

?>

<!-- Footer -->
<?php include('footer.php'); ?>
</body>
</html>
