<?php
include_once("mysqlClass.inc.php");
include_once("media_functions.php");
include_once("account_functions.php");

function message_exists($id)
{
    $query = "select * from Messages where messageID='$id'";
    $result = mysql_query( $query );
    if (!$result) {
        die ("message_exists() failed. Could not query the database: <br />".mysql_error());
    }
    else {
        $row = mysql_fetch_assoc($result);
        if($row == 0) {
            return False; # Message does not exist
        }
        else {
            return True; # Message exists
        }
    }
}

function send_message($sender, $reciever, $message)
{
    // Check sender exists
    if(!user_exists($sender))
        return 2;

    // Check reciever exists
    if(!user_exists($reciever))
        return 3;

    // Check message not blank
    if($message == NULL or $message == "")
        return 4;

    // Insert
    $insert = "INSERT INTO Messages (sender, reciever, message, date)"
    . " VALUES ('$sender', '$reciever', '$message')";
    $result = mysql_query( $insert );
    if($result)
        return 1;
    else
        die ("Could not add message to database: <br />". mysql_error());      
}

function delete_message($id)
{
    // Check message exists
    if(!message_exists($id))
        return 2;

    // Delete message
    $delete = "DELETE FROM Messages where messageID = '$id'";
    $result = mysql_query($delete);
    if($result) {
        return 1;
    }
    else 
        die ("Could not delete from the database: <br />". mysql_error());      
}

function edit_message($id, $message)
{
    // Check comment exists
    if(!message_exists($id))
        return 2;

    // Update comment
    $update = "UPDATE Messages SET message = '$message' where messageID = '$id'";
    $result = mysql_query($update);
    if($result) {
        return 1;
    }
    else
        die ("Could not edit message: <br />". mysql_error());
}

function get_conversation($user, $user2)
{
    // Check user exists
    if(!user_exists($user))
        return -1;

    // Check user2 exists
    if(!user_exists($user2))
        return -2;

    // Collect results
    $query = "SELECT * FROM Messages where (sender = '$user' and reciever = '$user2')"
    . "or (sender = '$user2' and reciever = '$user') order by messageID asc";

    // Return results
    $result =  mysql_query($query);
    if($result)
        return $result;
    else
        die("Could not get conversation: <br />". mysql_error());
}

function get_conversation_list($user)
{
    // Check user exists
    if(!user_exists($user))
        return -1;

    // Collect results
    $query = "SELECT * FROM Messages where (sender = '$user' or reciever = '$user')";
    
    // Return results
    $result = mysql_query($query);
    if($result)
        return $result;
    else
        die("Could not find conversations: <br />". mysql_error());

}

?>

