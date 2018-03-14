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
	else {
		$check = user_exist_check($_POST['username'], $_POST['passowrd1']);	
		if($check == 1){
			//echo "Rigister succeeds";
			$_SESSION['username']=$_POST['username'];
			header('Location: .');
		}
		else if($check == 2){
			$register_error = "Username already exists. Please user a different username.";
		}
	}
}

?>
<form action="register.php" method="post" style="max-width:200px; margin: 20px" class="mx-auto">
  <div class="form-group">
    <input type="text" name="username" placeholder="Username">
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
   {  echo "<div id='passwd_result'> register_error:".$register_error."</div>";}
?>

<?php
    include('footer.php');
?>
</body>
</html>
