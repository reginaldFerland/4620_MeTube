<?php
include_once("account_functions.php");
include_once("mysqlClass.inc.php");
include_once("media_functions.php");

function create_playlist($owner, $name, $description=NULL)
{
    // Check Owner exists
    if(!user_exists($owner))
        return 2;

    // Check name not null
    if($name == NULL or $name == "")
        return 3;

    // Create playlist
    $insert = "INSERT INTO Playlist (owner, name, creation_time, last_access";
    if($description != NULL)
        $insert .= ", description";
    $insert .= ") values (";

    // Add values
    $insert .= "'$owner','$name','$date','$date'";
    if($description != NULL)
        $insert .= ", '$description'";
    $insert .= ")";

    // Upload
    $result = mysql_query($insert);
    if($result)
        return 1;
    else
        die ("Could not insert into the database: <br />". mysql_error());      
}

function playlist_exists($id)
{
    $query = "SELECT * from Playlist where playlistID ='$id'";
    $result = mysql_query($query);
    if (!$result) {
        die ("playlist_exists() failed. Could not query the database: <br />".mysql_error());
    }
    else {
        $row = mysql_fetch_assoc($result);
        if($row == 0) {
            return False; # playlist does not exist
        }
        else {
            return True; # playlist exists
        }
    }
}

function remove_playlist($id)
{
    if(!playlist_exists($id))
        return 2;

    // Delete
    $delete = "delete from Playlist where playlistID='$id'";
    $result = mysql_query($delete);
    if($result) {
        return 1;
    }
    else 
        die ("Could not delete from the database: <br />". mysql_error());      
}

?>
