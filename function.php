<?php
include "mysqlClass.inc.php";

function user_exist_check ($username) {
    $query = "select * from Account where username='$username'";
    $result = mysql_query( $query );
    if (!$result) {
        die ("user_exist_check() failed. Could not query the database: <br />".mysql_error());
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

function email_exist_check ($email) {
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
    $date = date('c');
    $query = "insert into Account (username, email, password, join_date) values ('$username','$email','$password','$date')";
    $insert = mysql_query( $query );
    if($insert)
        return 1;
    else
        die ("Could not insert into the database: <br />". mysql_error());      
 
}

function user_pass_check($username, $password)
{
    
    $query = "select * from Account where username='$username'";
    $result = mysql_query( $query );
        
    if (!$result)
    {
       die ("user_pass_check() failed. Could not query the database: <br />". mysql_error());
    }
    else{
        $row = mysql_fetch_assoc($result);
        if(strcmp($row['password'],$password))
            return 2; //wrong password
        else 
            return 0; //Checked.
    }   
}

function updateMediaTime($mediaid)
{
    $query = "  update Media set lastaccesstime=NOW() WHERE '$mediaid' = mediaid ";
    // Run the query created above on the database through the connection
    $result = mysql_query( $query );
    if (!$result)
    {
       die ("updateMediaTime() failed. Could not query the database: <br />". mysql_error());
    }
}

function upload_error($result)
{
    //view erorr description in http://us2.php.net/manual/en/features.file-upload.errors.php
    switch ($result){
    case 1:
        return "UPLOAD_ERR_INI_SIZE";
    case 2:
        return "UPLOAD_ERR_FORM_SIZE";
    case 3:
        return "UPLOAD_ERR_PARTIAL";
    case 4:
        return "UPLOAD_ERR_NO_FILE";
    case 5:
        return "File has already been uploaded";
    case 6:
        return  "Failed to move file from temporary directory";
    case 7:
        return  "Upload file failed";
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

function incrementViewCount($id)
{
    $update = "UPDATE Media SET viewcount = viewcount +1 where mediaid = '". $id ."'";
    mysql_query ($update);
}

function updateLastView($id)
{
    $update = "UPDATE Media SET last_access = '".date('c')."' where mediaid = '".$id."'";
    mysql_query($update);

}

function is_blocked($user, $blocker)
{
    $query = "select * from Blocked_user where username='$blocker' and blocked='$user'";
    $result = mysql_query( $query );
    if (!$result) {
        die ("user_exist_check() failed. Could not query the database: <br />".mysql_error());
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

function is_friends($user, $friend)
{
    $query = "select * from Contact where username='$user' and friend='$friend'";
    $result = mysql_query( $query );
    if (!$result) {
        die ("user_exist_check() failed. Could not query the database: <br />".mysql_error());
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
    // Check that friend is real
    if(!user_exist_check($friend)) {
        return 1;   // Friend does not exist
    }

    // Check that user is not blocked
    if(is_blocked($user, $friend)) {
        return 2;   // user is blocked
    }

    // Check that user is not already friends
    if(is_friends($user, $friend)) {
        return 3;   // Already Friends
    }

    // Update tables
    $insert = "insert into Contact(username, friend, category) values ('$user', '$friend', '$type')";
    $result = mysql_query($insert);
    if($insert)
        return 1;
    else
        die ("Could not insert into the database: <br />". mysql_error());      
 
}

function other()
{
    //You can write your own functions here.
}
    
?>
