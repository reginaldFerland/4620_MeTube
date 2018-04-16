<!doctype html>
<html>
<head>
<title>MeTube - Register</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>

<?php
    include('header.php');
?>

<?php
session_save_path("/home/rferlan/public_html/metube/session");
session_start();

include_once "function.php";

if(isset($_POST['submit'])) {
    if( $_POST['passowrd1'] != $_POST['passowrd2']) {
        $register_error = "Passwords don't match. Try again?";
    }
    else 
    {
        $checkEmail = validate_email($_POST['email']);
        if($checkEmail == 1){
            if((!user_exist_check($_POST['username'])) and (!email_exist_check($_POST['email']))) {
                create_user($_POST['username'], $_POST['email'], $_POST['passowrd1']);
                $_SESSION['username']=$_POST['username'];
                header('Location: ./profile_edit.php');
            }

/*
            check_user_exists($_POST['username']);
            if($check == 1){
                //echo "Register succeeds";
                $_SESSION['username']=$_POST['username'];
                header('Location: ./profile_edit.php');
            }
            else if($check == 2){
                $register_error = "Username already exists. Please use a different username.";
            }
            else if($check == 3){
                $register_error = "Email already exists. Please use a different email.";
            }
*/
        }
        else{
            // Bad email
            $register_error = "Invalid Email";
        }

    }
}

?>
<form action="register.php" method="post" style="max-width:200px; margin: 20px" class="mx-auto">
    <div class="form-group">
        <input type="text" name="username" placeholder="Username">
    </div>
    <div class="form-group">
        <input type="text" name="email" placeholder="Email">
    </div>
    <div class="form-group">
        <input  type="password" name="passowrd1" placeholder="Password">
    </div>
    <div class="form-group">
        <input type="password" name="passowrd2" placeholder="Repeat Password">
    </div>
    <div class="form-group">
        <input name="submit" type="submit" value="Submit">
    </div>
</form>

<?php
    if(isset($register_error))
    {  
        echo "<div id='passwd_result'> register_error:".$register_error."</div>";
    }
?>

<?php
    include('footer.php');
?>
</body>
</html>
