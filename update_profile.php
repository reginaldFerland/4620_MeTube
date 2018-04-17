
<?php
session_save_path("/home/rferlan/public_html/metube/session");
session_start(); 
#include_once('function.php');
include_once('functions/account_functions.php');

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

if(!password_check($username, $password)) {
    header("Location: profile.php?username=".$username);
}
else
{
    
    if($new_password != $new_password2) {
        header("Location: profile.php?username=".$username);
    }
    else
    {

        if(!empty($pic)) {
            change_pic($username, $pic);
        }

        if(!empty($name)) {
            change_name($username, $name);
        }

        if(!empty($email)) {
            change_email($username, $email);
        }

        if(!empty($about)) {
            change_about($username, $about);
        }
    
        if(!empty($new_password)) {
            change_password($username, $new_password);
        }

        header("Location: profile.php?username=".$username);

        return 0;
    }
}
?>

