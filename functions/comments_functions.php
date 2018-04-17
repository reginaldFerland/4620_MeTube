<?php
include_once("mysqlClass.inc.php");
include_once("media_functions.php");
include_once("account_functions.php");

function comment_exists($id)
{
    $query = "select * from Comments where commentID='$id'";
    $result = mysql_query( $query );
    if (!$result) {
        die ("comment_exists() failed. Could not query the database: <br />".mysql_error());
    }
    else {
        $row = mysql_fetch_assoc($result);
        if($row == 0) {
            return False; # Comment does not exist
        }
        else {
            return True; # Comment exists
        }
    }
}

function create_comment($user, $id, $comment)
{
    // Check user exists
    if(!user_exists($user))
        return 2;

    // Check media exists
    if(!media_exists($id))
        return 3;

    // Insert
    $insert = "INSERT INTO Comments (mediaID, username, comment)"
    . " VALUES ('$id', '$user', '$comment')";
    $result = mysql_query( $insert );
    if($result)
        return 1;
    else
        die ("Could not insert into the database: <br />". mysql_error());      
}

function delete_comment($id)
{
    // Check comment exists
    if(!comment_exists($id))
        return 2;

    // Delete comment
    $delete = "DELETE FROM Comments where commentID = '$id'";
    $result = mysql_query($delete);
    if($result) {
        return 1;
    }
    else 
        die ("Could not delete from the database: <br />". mysql_error());      
}

function edit_comment($id, $comment)
{
    // Check comment exists
    // Check comment exists
    if(!comment_exists($id))
        return 2;

    // Update comment
    $update = "UPDATE Comments SET comment = '$comment' where commentID = '$id'";
    $result = mysql_query($update);
    if($result) {
        return 1;
    }
    else
        die ("Could not update comment: <br />". mysql_error());
}

function get_media_comments($id, $order="ASC")
{
    // Check media exists
    if(!media_exists($id))
        return -1;

    // Collect results
    $query = "SELECT * FROM Comments where mediaID = '$id' order by '$order'";

    // Return results
    $results = mysql_query($query);
    if($results) 
        return $results;
    else
        die ("Could not search comments: <br/>". mysql_error());
}

?>

