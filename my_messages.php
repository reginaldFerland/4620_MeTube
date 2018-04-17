<?php
include_once("functions/contact_functions.php");
include_once("functions/message_functions.php");
session_save_path("/home/rferlan/public_html/metube/session");
session_start(); 

$username = $_SESSION['username'];

$conversations = get_conversation_list($username);
?>

<h1 class="center-text"> Messages </h1>
<?php
    while($conversation = mysql_fetch_assoc($conversations))
    {
    # Determine who I'm talking too
    if($conversation['sender'] != $username)
        $other = $conversation['sender'];
    else
        $other = $conversation['reciever'];

    # Display conversation
    echo "<p>" .$other . "</p>";

    }
   
?>

<h1 class="center-text"> Example conversation </h1>
<?php
    $conversation = get_conversation($username, $other);
    while($message = mysql_fetch_assoc($conversation)) 
    {
        echo "<p>". $message['sender'] . "->" . $message['reciever'] . "\n";
        echo $message['message'] . "</p>";
    }
?>
