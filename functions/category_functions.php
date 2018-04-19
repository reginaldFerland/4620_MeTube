<?php
    include_once("media_functions.php");
    include_once("mysqlClass.inc.php");
    include_once("playlist_functions.php");

function add_media_category($mediaID, $category)
{
    // Check media exists
    if(!media_exists($mediaID))
        return 2;

    // Check if media already in category
    if(media_category_exists($mediaID, $category))
        return 3;

    // Insert
    $insert = "INSERT INTO Media_Categories (categories, mediaID) values ('$category', '$mediaID')";
    $result = mysql_query($insert); 
    if($result)
        return 1;
    else
        die ("Could not insert into the database: <br />". mysql_error());      
    
     
}

function media_category_exists($id, $cat)
{
    // Check combo exists
    $query = "SELECT * FROM Media_Categories where categories = '$cat' and mediaID = '$id'";
    $result = mysql_query( $query );
    if (!$result) {
        die ("media_category_exists() failed. Could not query the database: <br />".mysql_error());
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

function add_playlist_category($playlistID, $category)
{
    // Check media exists
    if(!playlist_exists($playlistID))
        return 2;

    // Check if media already in category
    if(playlist_category_exists($playlistID, $category))
        return 3;

    // Insert
    $insert = "INSERT INTO Playlist_Categories (categories, playlistID) values ('$category', '$playlistID')";
    $result = mysql_query($insert); 
    if($result)
        return 1;
    else
        die ("Could not insert into the database: <br />". mysql_error());      
    
     
}

function playlist_category_exists($id, $cat)
{
    // Check combo exists
    $query = "SELECT * FROM Playlist_Categories where categories = '$cat' and playlistID = '$id'";
    $result = mysql_query( $query );
    if (!$result) {
        die ("playlist_category_exists() failed. Could not query the database: <br />".mysql_error());
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

function remove_media_category($id, $cat)
{
    // Check exists
    if(!media_category_exists($id, $cat)) {
        return 2;
    }

    // Remove
    $delete = "delete from Media_Categories where categories = '$cat' and mediaID = '$id'";
    $result = mysql_query($delete);
    if($result) {
        return 1;
    }
    else 
        die ("Could not delete from the database: <br />". mysql_error());      
}

function get_all_media_from_category($cat)
{
    // Query
    $query = "SELECT * FROM Media_Categories INNER JOIN Media ON Media.mediaID = Media_Categories.mediaID INNER JOIN Upload ON Upload.mediaID = Media.mediaID where categories = '$cat' ORDER by viewcount DESC";
    $result = mysql_query( $query );
    if (!$result) {
        die ("get_all_media_from_category() failed. Could not query the database: <br />".mysql_error());
    }
    else {
        return $result;
    }
}

function get_all_category_from_media($id)
{
    // Query
    $query = "SELECT * FROM Media_Categories where mediaID = '$id'";
    $result = mysql_query( $query );
    if (!$result) {
        die ("get_all_category_from_media() failed. Could not query the database: <br />".mysql_error());
    }
    else {
        return $result;
    }
}
