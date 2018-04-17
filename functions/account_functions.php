<?php
include_once("mysqlClass.inc.php");
include_once("blocked_user_functions.php");

function user_exists ($username) {
    $query = "select * from Account where username='$username'";
    $result = mysql_query( $query );
    if (!$result) {
        die ("user_exists() failed. Could not query the database: <br />".mysql_error());
    }
    else {
        $row = mysql_fetch_assoc($result);
        if($row == 0) {
            return False; # User does not exist
        }
        else {
            return True; # User exists
        }
    }
}

function email_exists ($email) {
    $query = "select * from Account where email='$email'";
    $result = mysql_query( $query );
    if (!$result) {
        die ("email_exist_check() failed. Could not query the database: <br />".mysql_error());
    }
    else {
        $row = mysql_fetch_assoc($result);
        if($row == 0) {
            return False; # Email does not exist in database
        }
        else {
            return True; # Email is in database
        }
    }
}

function create_user ($username, $email, $password)
{
    if(user_exists($username)) {
        return 2;
    }
    if(email_exists($email)) {
        return 3;
    }
    if(validate_email($email) != 1) {
        return 4;
    }
    $date = date('c');
    $query = "insert into Account (username, email, password, join_date) values ('$username','$email','$password','$date')";
    $insert = mysql_query( $query );
    if($insert)
        return 1;
    else
        die ("Could not insert into the database: <br />". mysql_error());      
 
}

function password_check($username, $password)
{
    if(!user_exists($username)) {
        return False;
    }
    
    $query = "select * from Account where username='$username'";
    $result = mysql_query( $query );
        
    if (!$result)
    {
       die ("password_check() failed. Could not query the database: <br />". mysql_error());
    }
    else{
        $row = mysql_fetch_assoc($result);
        if(strcmp($row['password'],$password))
            return False; //wrong password
        else 
            return True; //Checked.
    }   
}

function validate_email($email)
{
    if(!isset($email)) {
        return 2;
    }

    if(!(strpos($email, "@") !== False)) {
        return 3;
    }

    if(!((strpos($email, ".com") !== False) or (strpos($email, ".edu")!== False))) {
        return 4;
    }

    return 1;

}

function remove_user($user)
{
    // Check user exists
    if(!user_exists($user)) {
        return 2;
    }

    // Remove user
    $delete = "delete from Account where username='$user'";
    $result = mysql_query($delete);
    if($result) {
        return 1;
    }
    else 
        die ("Could not delete from the database: <br />". mysql_error());      

}

function change_password($user, $password)
{
    // Check user exists
    if(!user_exists($user)) {
        return 2;
    }

    // Change password
    $update = "UPDATE Account SET password = '$password' where username = '$user'";
    $result = mysql_query($update);
    if($result) {
        return 1;
    }
    else
        die ("Could not update password: <br />". mysql_error());
}

function change_email($user, $email)
{
    // Check user exists
    if(!user_exists($user)) {
        return 2;
    }

    // Check email valid
    if(validate_email($email) != 1) {
        return 3;
    }

    // Check email isn't in use
    if(email_exists($email)) {
        return 4;
    }

    // Update
    $update = "UPDATE Account set email = '$email' where username = '$user'";
    $result = mysql_query($update);
    if($result) {
        return 1;
    }
    else
        die ("Could not update email: <br />" .mysql_error());
}

function change_name($user, $name)
{
    // Check user exists
    if(!user_exists($user)) {
        return 2;
    }

    // Update name
    $update = "UPDATE Account set name = '$name' where username = '$user'";
    $result = mysql_query($update);
    if($result) {
        return 1;
    }
    else
        die ("Could not update name: <br />" .mysql_error());
}

function change_about($user, $about)
{
    // Check user exists
    if(!user_exists($user)) {
        return 2;
    }

    // Update name
    $update = "UPDATE Account set about = '$about' where username = '$user'";
    $result = mysql_query($update);
    if($result) {
        return 1;
    }
    else
        die ("Could not update about: <br />" .mysql_error());
}

function increment_upload($user)
{
    // Check user exists
    if(!user_exists($user)) {
        return 2;
    }

    // Update
    $update = "UPDATE Account set upload = upload + 1 where username = '$user'";
    $result = mysql_query($update);
    if($result) {
        return 1;
    }
    else
        die ("Could not update upload count: <br />" .mysql_error());

}

function change_pic($user, $mediaID=1)
{
    // Check user exists
    if(!user_exists($user)) {
        return 2;
    }

    // Check mediaID valid
    $query = "SELECT * from Media where mediaID = '$mediaID'";
    $result = mysql_query( $query );
    if (!$result) {
        die ("change_pic() failed. Could not query the database: <br />".mysql_error());
    }
    else {
        $row = mysql_fetch_assoc($result);
        if($row == 0) {
            return 3; # Image does not exist
        }
    }

    // Update
    $update = "UPDATE Account set mediaID = '$mediaID' where username = '$user'";
    $result = mysql_query($update);
    if($result) {
        return 1;
    }
    else
        die ("Could not update picture: <br />" .mysql_error());
}

function get_uploads($user)
{
    // Check if user exists
    if(!user_exists($user))
        return -1;

    // Query 
    $query = "select * from Account where username='$user'";
    $result = mysql_query( $query );
    if (!$result) {
        die ("get_uploadss() failed. Could not query the database: <br />".mysql_error());
    }
    else {
        $row = mysql_fetch_assoc($result);
        return $row["upload"];
    }

}

function get_user_info($user)
{
    // Check user exists
    if(!user_exists($user))
        return -1;
    
    // Query 
    $query = "select * from Account where username='$user'";
    $result = mysql_query( $query );
    if (!$result) {
        die ("get_uploadss() failed. Could not query the database: <br />".mysql_error());
    }
    else {
        return mysql_fetch_assoc($result);
    }
}

?>
