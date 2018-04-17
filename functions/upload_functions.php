<?php
include_once("mysqlClass.inc.php");
include_once("account_functions.php");
include_once("media_functions.php");

function create_upload($user, $id, $ip)
{
    // Check user real
    if(!user_exists($user))
        return 2;

    // Check id real
    if(!media_exists($id))
        return 3;

    // Check not already in Upload
    if(upload_exists($user, $id))
        return 4;

    // Insert into Upload
    $date = date('c');
    $insert = "INSERT INTO Upload (username, mediaID, ip, upload_time)"
    . " VALUES ('$user', '$id', '$ip', '$date')";
    $result = mysql_query( $insert );
    if($result)
        return 1;
    else
        die ("Could not insert into the database: <br />". mysql_error());      
}

function upload_exists($user, $id)
{
    // Query
    $query = "SELECT * FROM Upload where username = '$user' and mediaID = '$id'";
    $result = mysql_query( $query );
    if (!$result) {
        die ("upload_exists() failed. Could not query the database: <br />".mysql_error());
    }
    else {
        $row = mysql_fetch_assoc($result);
        if($row == 0) {
            return False; # Upload does not exist
        }
        else {
            return True; # Upload exists
        }
    }
}

function remove_upload($user, $id)
{
    // Check User exists
    if(!user_exists($user))
        return 2;

    // Check id exists
    if(!media_exists($id))
        return 3;

    // Check upload exists
    if(!upload_exists($user, $id))
        return 4;

    // Remove from media (This will cascade delete from Upload)
    return remove_media($id);
}








?>
