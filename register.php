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

include_once "functions/account_functions.php";

if(isset($_POST['submit'])) {
    if( $_POST['passowrd1'] != $_POST['passowrd2']) {
        $register_error = "Passwords don't match. Try again?";
    }
    else 
    {
        $checkEmail = validate_email($_POST['email']);
        if($checkEmail == 1){
            if((!user_exists($_POST['username'])) and (!email_exists($_POST['email']))) {
                create_user($_POST['username'], $_POST['email'], $_POST['passowrd1']);
                $_SESSION['username']=$_POST['username'];
                header('Location: ./profile_edit.php');
            }
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
