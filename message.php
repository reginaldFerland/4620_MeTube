<!doctype html>
<html>
<head>
<title>Messages</title>
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
    include_once("functions/media_functions.php");

    $username = $_SESSION['username'];

    if(!user_exists($username))
        header("Location: index.php");

    $friend = $_REQUEST['friend'];

    if(!user_exists($friend))
        header("Location: index.php");

?>

<!-- Include same header across website -->
<?php
    include('header.php');
?>

<h1 class="text-center jumbotron mx-auto"> Conversation - <?php echo $friend;?> </h1>

<form class="form-group" action="send_message.php" method="POST" enctype="multipart/form-data">
    <input name="reciever" hidden value=<?php echo $friend;?>></input>
    <textarea name="message" class="form-control text-center" placeholder="Send a message!"></textarea>
    <button class="btn btn-primary mx-auto" type="submit">Send</button>
</form>



<?php
$conversation = get_conversation($username, $friend);

while($message = mysql_fetch_assoc($conversation))
{
$sender = $message['sender'];
$mediaID = get_user_info($sender)['mediaID'];
$sender_picture = get_media_info($mediaID);
$picture_path = $sender_picture['path'];
?>
    <div class="row">
    <div class="col-sm-1">
        <div class="thumbnail">
            <img class="img-responsive user-photo" style="width:50px; height:50px" src="<?php echo $picture_path;?>">
        </div><!-- /thumbnail -->
    </div><!-- /col-sm-1 -->

    <div class="col-sm-5">
    <div class="panel panel-default">
    <div class="panel-heading">
    <strong><?echo $message['sender'];?></strong> </div>
        <div class="panel-body">
            <?php echo $message['message'];?>
        </div><!-- /panel-body -->
    </div><!-- /panel panel-default -->
    </div><!-- /col-sm -->
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
