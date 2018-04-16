<?php
session_save_path("/home/rferlan/public_html/metube/session");
session_start();
include_once "function.php";

/******************************************************
*
* upload document from user
*
*******************************************************/

$username=$_SESSION['username'];


//Create Directory if doesn't exist
if(!file_exists('uploads/'))
    mkdir('uploads/', 0757);
$dirfile = 'uploads/'.$username.'/';
if(!file_exists($dirfile))
    mkdir($dirfile,0755);

    chmod( $dirfile,0755);
    if($_FILES["file"]["error"] > 0 )
    {   
        $result=$_FILES["file"]["error"];
    } //error from 1-4
    else
    {
        // Create unique server filename
        $original_filename = $_FILES["file"]["name"];
        $file_ext = substr($original_filename, strripos($original_filename, '.'));
        $upload_query = "select upload from Account where username = '" .$username."'";
        $results = mysql_query($upload_query);
        $results_row = mysql_fetch_assoc($results);
        $file_basename = $results_row["upload"];
        $file_path = $dirfile . $file_basename . $file_ext;
        
        // Meta Data creation
        if(!empty($_POST["name"])) {
            $name = $_POST["name"];
        }
        else {
            $name = substr($original_filename,0,strripos($original_filename,'.'));
        }
        $description = $_POST["description"];
        $date = date('c');
        
        // Update account
        $update = "UPDATE Account set upload = upload + 1 where username = '" . $username . "'";
        mysql_query($update);

        // Check file uploaded and insert into media and uploads
        if(is_uploaded_file($_FILES["file"]["tmp_name"]))
        {
            if(!move_uploaded_file($_FILES["file"]["tmp_name"],$file_path))
            {
                $result="6"; //Failed to move file from temporary directory
            }
            else #Successfully upload file
            {
                //insert into media table
                $insert = "insert into Media(path, type, name, last_access, description, public)".
                "values('".$file_path."', '".$_FILES["file"]["type"]."', '".$name."', '".$date."', '".$description."', '1' )";
                $queryresult = mysql_query($insert)
                or die("Insert into Media error in media_upload_process.php " .mysql_error());

                // Insert into Upload table
                #$result_row = mysql_fetch_assoc($queryresult);
                $mediaID = mysql_insert_id(); #$result_row["mediaID"];
                $ip = $_SERVER['REMOTE ADDR'];
                $insert = "insert into Upload(username, mediaID, ip, upload_time)".
                "values('$username','$mediaID','$ip','$date')";
                $q_result = mysql_query($insert)
                or die("Insert into Upload error in media_upload_process.php". mysql_error());

                $result="0";
                chmod($file_path, 0644);
            }
        }
        else  
        {
            $result="7"; //upload file failed
        }
    }
    
    //You can process the error code of the $result here.
?>

<meta http-equiv="refresh" content="0;url=.?result=<?php echo $result;?>">
