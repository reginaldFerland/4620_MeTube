<?php
include_once("mysqlClass.inc.php");

function category_exists($category)
{
    $query = "SELECT * from Categories where category = '$category'";
    $result = mysql_query( $query );
    if (!$result) {
        die ("category_exists() failed. Could not query the database: <br />".mysql_error());
    }
    else {
        $row = mysql_fetch_assoc($result);
        if($row == 0) {
            return False; # category does not exist
        }
        else {
            return True; # category exists
        }
    }
}

function add_category($category)
{
    // Check exists
    if(category_exists($category))
        return 2;

    // Add
    $insert = "INSERT INTO Categories (category) values ('$category')";
    $result = mysql_query( $insert );
    if (!$result) 
        return 1;
    else
        die ("add_category() failed. Could not insert to the database: <br />".mysql_error());
}

function remove_category($category)
{
    // Check exists
    if(!category_exists($category))
        return 2;

    // Delete
    $delete = "DELETE FROM Categories where category = '$category'";
    $result = mysql_query($delete);
    if($result) {
        return 1;
    }
    else 
        die ("Could not delete from the database: <br />". mysql_error());      
}


?>
