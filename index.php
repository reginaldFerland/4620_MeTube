<!doctype html>
<html>
<head>
<title>MeTube</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>

<?php
    session_save_path("./session");
    session_start();
?>

<!-- Include same header across website -->
<?php
    include('header.php');
?>

<?php
    include('browse.php');
?>

<!-- Include same footer across website -->
<?php
    include('footer.php');
?>
</body>
</html>
