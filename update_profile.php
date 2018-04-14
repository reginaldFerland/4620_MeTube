
<?php
session_save_path("/home/rferlan/public_html/metube/session");
session_start(); 
include_once('function.php');

$username = $_SESSION['username'];

#Variables
$pic = $_POST['profile'];
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$email = $_POST['email'];
$new_password = $_POST['passowrd1'];
$new_password2 = $_POST['passowrd2'];
$password = $_POST['password'];

# Check password

$query = "SELECT * from account where username = '" .$username . "'";
$result = mysql_query($query);
$result_row = mysql_fetch_assoc($result);
$current_password = $result_row['password'];

$UPDATE = "UPDATE account SET ";

if($password != $current_password) {
    return 1;
}

if($new_password != $new_password2) {
    return 2;
}

if(!empty($pic)) {
    $UPDATE .= "mediaid = '" .$pic . "', ";
}

if(!empty($fname)) {
    $UPDATE .= "fname = '" .$fname ."', ";
}

if(!empty($lname)) {
    $UPDATE .= "lname = '" .$lname ."', ";
}

if(!empty($email)) {
    $UPDATE .= "email = '" .$email ."', ";
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

