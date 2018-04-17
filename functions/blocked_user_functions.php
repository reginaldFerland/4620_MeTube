<?php
include_once("mysqlClass.inc.php");
include_once("account_functions.php");

function is_blocked($user, $block)
{
    $query = "select * from Blocked_user where username='$user' and blocked='$block'";
    $result = mysql_query( $query );
    if (!$result) {
        die ("is_blocked() failed. Could not query the database: <br />".mysql_error());
    }
    else {
        $row = mysql_fetch_assoc($result);
        if($row == 0) {
            return False; # User is not blocked
        }
        else {
            return True; # User is blocked
        }
    }
}

function block_user($user, $block)
{
    // Check user real
    if(!user_exists($user))
        return 2;

    // Check block real
    if(!user_exists($block))
        return 3;

    // Check if already blocked
    if(is_blocked($user, $block))
        return 4;

    // Block
    $insert = "INSERT INTO Blocked_user (username, blocked) values ('$user', '$block')";
    $result = mysql_query( $insert );
    if ($result) {
        return 1;
    }
    else {
        die ("block_user() failed. Could not update the database: <br />".mysql_error());
    }
}

function unblock_user($user, $block)
{
    // Check user real
    if(!user_exists($user))
        return 2;

    // Check block real
    if(!user_exists($block))
        return 3;

    // Check if already blocked
    if(!is_blocked($user, $block))
        return 4;

    // unblock
    $delete = "DELETE from Blocked_user where username='$user' and blocked='$block'";
    $result = mysql_query( $delete );
    if ($result) {
        return 1;
    }
    else {
        die ("unblock_user() failed. Could not update the database: <br />".mysql_error());
    }
}
    
?>
