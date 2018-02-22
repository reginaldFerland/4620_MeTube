<!doctype html>
<!-- For login management -->
<?php session_start(); ?>

<html>
<head>
<!-- Use php to create title -->
<title> <?php if(isset($_SESSION['username'])){ echo $_SESSION['username'];} else {header("Location: index.php");}?> </title>

<!-- Add css sheet -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">

</head>
<body>
<!-- Header -->
<?php include('header.php'); ?>

placeholder

<!-- Footer -->
<?php include('footer.php'); ?>
</body>
</html>
