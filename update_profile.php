
<?php
session_save_path("/home/rferlan/public_html/metube/session");
session_start(); 
include_once('function.php');

$username = $_SESSION['username'];

#Variables
$pic = $_POST['profile'];
$name = $_POST['name'];
$email = $_POST['email'];
$about = $_POST['about'];
$new_password = $_POST['passowrd1'];
$new_password2 = $_POST['passowrd2'];
$password = $_POST['password'];

# Check password

$query = "SELECT * from Account where username = '" .$username . "'";
$result = mysql_query($query);
$result_row = mysql_fetch_assoc($result);
$current_password = $result_row['password'];

$UPDATE = "UPDATE Account SET ";

if($password != $current_password) {
    header("Location: profile.php?username=".$username);
}

if($new_password != $new_password2) {
    header("Location: profile.php?username=".$username);
}

if(!empty($pic)) {
    $UPDATE .= "mediaID = '" .$pic . "', ";
}

if(!empty($name)) {
    $UPDATE .= "name = '" .$name ."', ";
}

if(!empty($email)) {
    $UPDATE .= "email = '" .$email ."', ";
}

if(!empty($about)) {
    $UPDATE .= "about = '" . $about ."', ";
}

if(!empty($new_password)) {
    $UPDATE .= "password = '" .$new_password ."', ";
}

$UPDATE = rtrim($UPDATE, ', ');
$UPDATE .= " WHERE username = '" .$username."'";

mysql_query ($UPDATE);

header("Location: profile.php?username=".$username);

return 0;
?>

