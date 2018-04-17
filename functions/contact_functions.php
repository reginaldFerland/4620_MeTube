<?php
include_once("../mysqlClass.inc.php");
include_once("account_functions.php");
include_once("blocked_user_functions.php");

function is_friends($user, $friend)
{
    if(!user_exists($user) or !user_exists($friend))
        return False;
    $query = "select * from Contact where username='$user' and friend='$friend'";
    $result = mysql_query( $query );
    if (!$result) {
        die ("is_friends() failed. Could not query the database: <br />".mysql_error());
    }
    else {
        $row = mysql_fetch_assoc($result);
        if($row == 0) {
            return False; # User not friends
        }
        else {
            return True; # User is friends
        }
    }
}

function add_friend($user, $friend, $type='none')
{
    // Check that user is real
    if(!user_exists($user)) {
        return 2;   // User does not exist
    }
    // Check that friend is real
    if(!user_exists($friend)) {
        return 3;   // Friend does not exist
    }

    // Check that user is not blocked
    if(is_blocked($user, $friend)) {
        return 4;   // user is blocked
    }

    // Check that user is not already friends
    if(is_friends($user, $friend)) {
        return 5;   // Already Friends
    }

    // Update tables
    $insert = "insert into Contact(username, friend, category) values ('$user', '$friend', '$type')";
    $result = mysql_query($insert);
    if($insert)
        return 1;
    else
        die ("Could not insert into the database: <br />". mysql_error());      
 
}

function remove_friend($user, $friend)
{
    // Check user exists
    if(!user_exists($user)) {
        return 2;
    }

    // Check friend exists
    if(!user_exists($friend)) {
        return 3;
    }

    // Check that they are friends
    if(!is_friends($user, $friend)) {
        return 4;
    }

    $drop = "delete from Contact where username = '$user' and friend = '$friend'";
    $result = mysql_query($drop);
    if($result)
        return 1;   
    else
        die ("Could not delete from database: <br />". mysql_error());

}

?>
