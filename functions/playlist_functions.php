<?php
include_once("account_functions.php");
include_once("mysqlClass.inc.php");
include_once("media_functions.php");

function create_playlist($owner, $name, $description=NULL)
{
    // Check Owner exists
    if(!user_exists($owner))
        return -2;

    // Check name not null
    if($name == NULL or $name == "")
        return -3;

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
        return mysql_insert_id();
    else
        die ("Could not insert into the database: <br />". mysql_error());      
}

function add_media_playlist($playlistID, $mediaID)
{
    // Check playlist exists
    if(!playlist_exists($playlistID))
        return 2;

    // Check media exists
    if(!media_exists($mediaID))
        return 3;

    // Check if media in playlist
    if(media_in_playlist($playlistID, $mediaID))
        return 4;

    // Insert
    $insert = "INSERT INTO Playlist_Media (playlistID, mediaID) VALUES ('$playlistID', '$mediaID')";

    // Return
    $result = mysql_query($insert);
    if($result)
        return 1;
    else
        die ("Could not insert into the database: <br />". mysql_error());      

}

function remove_media_playlist($playlistID, $mediaID)
{
    // Check playlist exists
    if(!playlist_exists($playlistID))
        return 2;

    // Check media exists
    if(!media_exists($mediaID))
        return 3;

    // Check if media in playlist
    if(!media_in_playlist($playlistID, $mediaID))
        return 4;

    // delete
    $delete = "DELETE FROM Playlist_Media WHERE playlistID ='$playlistID' and mediaID = '$mediaID'";

    // Return
    $result = mysql_query($delete);
    if($result)
        return 1;
    else
        die ("Could not delete from the database: <br />". mysql_error());      

}

function media_in_playlist($playlistID, $mediaID)
{
    // Query
    $query = "SELECT * from Playlist_Media where playlistID ='$playlistID' and mediaID = '$mediaID'";
    $result = mysql_query($query);
    if (!$result) {
        die ("media_in_playlist() failed. Could not query the database: <br />".mysql_error());
    }
    else {
        $row = mysql_fetch_assoc($result);
        if($row == 0) {
            return False; # does not exist
        }
        else {
            return True; # exists
        }
    }
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

function playlist_tag_exists($id, $tag)
{
    // Check playlist exists
    if(!playlist_exists($id))
        return 2;

    // Query
    $query = "SELECT * FROM Playlist_Tag WHERE playlistID = '$id' and tag = '$tag'";
    $result = mysql_query($query);
    if (!$result) {
        die ("playlist_tag_exists() failed. Could not query the database: <br />".mysql_error());
    }
    else {
        $row = mysql_fetch_assoc($result);
        if($row == 0) {
            return False; # playlis_tag does not exist
        }
        else {
            return True; # playlist_tag exists
        }
    }
}

function add_playlist_tag($id, $tag)
{
    // Check playlist exists
    if(!playlist_exists($id))
        return 2;

    // Check tag already on
    if(playlist_tag_exists($id, $tag))
        return 3;

    // Add tag to playlist_tag
    $insert = "INSERT INTO Playlist_Tag (playlistID, tag) values ('$id', '$tag')";
    $result = mysql_query($insert);
    if($result)
        return 1;
    else
        die ("Could not insert into the database: <br />". mysql_error());      

}

function remove_playlist_tag($id, $tag)
{
    // Check playlist exists
    if(!playlist_tag_exists($id, $tag))
        return 2;

    // Remove playlist_tag
    $delete = "DELETE FROM Playlist_Tag WHERE playlistID ='$id' and tag = '$tag'";
    $result = mysql_query($delete);
    if($result) {
        return 1;
    }
    else 
        die ("Could not delete from the database: <br />". mysql_error());      

}

function get_playlist_tags($id)
{
    // Check playlist exists
    if(!playlist_tag_exists($id, $tag))
        return 2;

    // Search for all tags
    $query = "SELECT * FROM Playlist_Tag WHERE playlistID = '$id'";

    // Return tags
    $result = mysql_query( $query );
    if (!$result) {
        die ("get_playlist_tags() failed. Could not query the database: <br />".mysql_error());
    }
    else {
        return $result;
    }
}

function get_user_playlists($username)
{
    // Check user exists
    if(!user_exists($username))
        return -1;

    // Search for all tags
    $query = "SELECT * FROM Playlist WHERE owner = '$username'";

    // Return tags
    $result = mysql_query( $query );
    if (!$result) {
        die ("get_playlist_tags() failed. Could not query the database: <br />".mysql_error());
    }
    else {
        return $result;
    }
}

function get_media_from_playlist($id)
{
    // Check exists
    if(!playlist_exists($id))
        return -1;

    // Search 
    $query = "SELECT Media.name, Media.mediaID, Media.type, Media.path, Media.description, Media.viewcount, Media.last_access "
    ." FROM Media INNER JOIN Playlist_Media on Media.mediaID = Playlist_Media.mediaID INNER JOIN Playlist on Playlist.playlistID = Playlist_Media.playlistID WHERE Playlist.playlistID = '$id'";

    // Return 
    $result = mysql_query( $query );
    if (!$result) {
        die ("get_media_from_playlists() failed. Could not query the database: <br />".mysql_error());
    }
    else {
        return $result;
    }
}

function get_favorite_id($user)
{
    // Check user exists
    if(!user_exists($user))
        return -1;

    // Search
    $query = "SELECT * FROM Playlist where name = 'Favorites' and owner = '$user'";

    // Return 
    $result = mysql_query( $query );
    if (!$result) {
        die ("get_favorite_id() failed. Could not query the database: <br />".mysql_error());
    }
    else {
        $row = mysql_fetch_assoc($result);
        return $row['playlistID'];
    }
}

function get_playlist_info($id)
{
    // Check user exists
    if(!playlist_exists($id))
        return -1;
    
    // Query 
    $query = "select * from Playlist where playlistID = '$id'";
    $result = mysql_query( $query );
    if (!$result) {
        die ("get_playlist_info() failed. Could not query the database: <br />".mysql_error());
    }
    else {
        return mysql_fetch_assoc($result);
    }
}


?>
