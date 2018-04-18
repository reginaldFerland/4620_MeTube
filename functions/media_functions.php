<?php
include_once('mysqlClass.inc.php');

function media_exists ($id) {
    $query = "select * from Media where mediaID='$id'";
    $result = mysql_query( $query );
    if (!$result) {
        die ("media_exists() failed. Could not query the database: <br />".mysql_error());
    }
    else {
        $row = mysql_fetch_assoc($result);
        if($row == 0) {
            return False; # Media does not exist
        }
        else {
            return True; # Media exists
        }
    }
}

function path_exists ($path) {
    $query = "select * from Media where path='$path'";
    $result = mysql_query( $query );
    if (!$result) {
        die ("media_exists() failed. Could not query the database: <br />".mysql_error());
    }
    else {
        $row = mysql_fetch_assoc($result);
        if($row == 0) {
            return False; # path does not exist
        }
        else {
            return True; # path exists
        }
    }
}

function add_media($path, $type, $name, $description=NULL, $public=True)
{
    // Check path unique
    if(path_exists($path))
        return -1;

    // Build Insert
    $insert = "INSERT INTO Media (path, type, name, last_access";
    $date = date('c');
    if($description != NULL)
        $insert .= ", description";
    if($public == False)
        $insert .= ", public";
    $insert.= ") values ('$path','$type','$name', '$date'";
    if($description != NULL)
        $insert .= ",'$description'";
    if($public == False)
        $insert .= ",'$public'";
    $insert .= ")";
    
    // Insert
    $result = mysql_query($insert);
    if($result)
        return mysql_insert_id();
    else
        die ("Could not insert into the database: <br />". mysql_error());      
 
}

function remove_media($id)
{
    // Check exists
    if(!media_exists($id))
        return 2;
    // Remove
    $delete = "DELETE FROM Media where mediaID = '$id'";
    $result = mysql_query($delete);
    if($result)
        return 1;
    else
        return 3;
}

function change_media_name($id, $name)
{
    // Check exists
    if(!media_exists($id))
        return 2;
    if($name == NULL)
        return 3;
    if($name == "")
        return 4;
    // Change name
    $update = "UPDATE Media SET name = '$name' WHERE mediaID='$id'";
    $result = mysql_query($update);
    if($result)
        return 1;
    else
        return 5;
}

function change_description($id, $desc)
{
    // Check exists
    if(!media_exists($id))
        return 2;
    if($desc == NULL)
        return 3;
    if($desc == "")
        return 4;
    // Change name
    $update = "UPDATE Media SET description = '$desc' WHERE mediaID='$id'";
    $result = mysql_query($update);
    if($result)
        return 1;
    else
        return 5;
}

function update_media_timestamp($id)
{
    // Check exists
    if(!media_exists($id))
        return 2;

    // Update time
    $date = date('c');
    $update = "UPDATE Media SET last_access = '$date' where mediaID = '$id'";
    $result = mysql_query($update);
    if($result)
        return 1;
    else
        return 5;
}   
    
function increment_views($id)
{
    // Check exists
    if(!media_exists($id))
        return 2;

    // increment_viewcount
    $update = "UPDATE Media SET viewcount = viewcount + 1 where mediaID = '$id'";
    $result = mysql_query($update);
    if($result)
        return 1;
    else
        return 5;
}   

function set_public($id, $public)
{
    // Check exists
    if(!media_exists($id))
        return 2;

    // increment_viewcount
    $update = "UPDATE Media SET public = '$public' where mediaID = '$id'";
    $result = mysql_query($update);
    if($result)
        return 1;
    else
        return 5;
}

function remove_like($id)
{
    // Check exists
    if(!media_exists($id))
        return 2;

    // increment_viewcount
    $update = "update Media set likes = likes - 1 where mediaID = '$id'";
    $result = mysql_query($update);
    if($result)
        return 1;
    else
        return 5;
}

function add_like($id)
{
    // Check exists
    if(!media_exists($id))
        return 2;

    // increment_viewcount
    $update = "UPDATE Media SET likes = likes + 1 where mediaID = '$id'";
    $result = mysql_query($update);
    if($result)
        return 1;
    else
        return 5;
}

function get_media_info($id)
{
    // Check media exists
    if(!media_exists($id))
        return -1;

    // Return results
    $query = "select * from Media INNER JOIN Upload on Media.mediaID =  Upload.mediaID where Media.mediaID='$id'";
    $result = mysql_query( $query );
    if (!$result) {
        die ("get_media_info() failed. Could not query the database: <br />".mysql_error());
    }
    else {
        return mysql_fetch_assoc($result);
    }

}


?>


