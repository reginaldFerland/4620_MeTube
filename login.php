<!doctype html>
<html>
<head>
<title>MeTube - Login</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
<link rel="stylesheet" type="text/css" href="css/default.css" />

<?php
    include('header.php');
?>

<?php
session_save_path("/home/rferlan/public_html/metube/session");
session_start();

include_once("functions/account_functions.php");

if(isset($_POST['submit'])) {
    if($_POST['username'] == "" || $_POST['password'] == "") {
        $login_error = "One or more fields are missing.";
    }
    else {
        $check = password_check($_POST['username'],$_POST['password']); // Call functions from account_functions.php
        if($check==False) {
            $login_error = "Incorrect password or username.";
        }
        else if($check==True){
            $_SESSION['username']=$_POST['username']; //Set the $_SESSION['username']
            header('Location: .');
        }       
    }
}


 
?>
<form method="post" action="<?php echo "login.php"; ?>" style="max-width: 500px; margin: 20px auto">
    <div class="form-group">
        <input class="form-control" type="username" name="username" placeholder="Username">
    </div>
    <div class="form-group">
        <input class="form-control" type="password" name="password" placeholder="Password">
    </div>
    <div class="form-group">
        <input name="submit" type="submit" value="Login">
    </div>

</form>

<?php
    if(isset($login_error)) {
        echo "<div id='passwd_result'>".$login_error."</div>";
    }
?>

<?php
    include('footer.php');
?>
</body>
</html>
