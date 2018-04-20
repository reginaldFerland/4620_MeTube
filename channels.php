<!DOCTYPE HTML>
<html>
<?php 
session_save_path("./session");
session_start(); 
include_once("functions/account_functions.php");
include_once("functions/media_functions.php");
?>

<head>
<title>Channels</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>

<?php
// Header
include("header.php");
?>
<h1 class="text-center jumbotron mx-auto"> CHANNELS </h1>
<?php
//  Get all users
$all_users = get_all_users();

// Loop
while($channel = mysql_fetch_assoc($all_users))
{
    // Channel name
    $username = $channel['username'];
?>
    <h1 class="text-center mx-auto">
        <a href="./profile.php?username=<?php echo $username;?>"><?php echo $username;?></a>
    </h1>

<?php
    // Get 4 most viewed from each
    $result = get_user_most_viewed($username);
    $LIMIT = 4;
    include("display_category.php");
}

include("footer.php");
?>
</body>
</html>
