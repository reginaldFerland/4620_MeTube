<!doctype html>
<html>
<head>
<title>Friends</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>

<?php
    session_save_path("./session");
    session_start();
    include_once("mysqlClass.inc.php");
    include_once("functions/account_functions.php");
    include_once("functions/contact_functions.php");
    include_once("functions/message_functions.php");

    $username = $_SESSION['username'];

    if(!user_exists($username))
        header("Location: index.php");

?>

<!-- Include same header across website -->
<?php
    include('header.php');
?>

<h1 class="text-center jumbotron mx-auto"> Friends </h1>

<?php
$friends_list = get_friends($username);

while($friend = mysql_fetch_assoc($friends_list))
{
    // Get last message from friend
    $message = get_last_message($friend['username'], $friend['friend']);

    // If none, offer to send message
    if($message == NULL or $message == "")
        $message = "Send a message!";

    $message = substr($message, 0, 50);
    
?>
    
    <div class="row">
        <h1 class="text-center mx-auto">
            <a class="mx-auto text-center" href="./profile.php?username=<?php echo $friend['friend'];?>"> <?php echo $friend['friend'];?></a>
        </h1>
        <a class="text-center mx-auto" href="./message.php?friend=<?php echo $friend['friend'];?>"><?php echo $message;?></a>
    </div>

<?php
}
?>



<!-- Include same footer across website -->
<?php
    include('footer.php');
?>
</body>
</html>
