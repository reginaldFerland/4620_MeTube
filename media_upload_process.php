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
        $upfile = $dirfile.urlencode($_FILES["file"]["name"]);
      
        if(isset($_POST["name"])) {
            $postname = $_POST["name"];
        }
        else {
            $postname = $_FILES["file"]["name"];
        }
        $filename = $_FILES["file"]["name"];
        $uploads = "select uploads from account where username = '" . $username . "'";
        $results = mysql_query($uploads);
        $results_row = mysql_fetch_assoc($results);
        $file_basename = $results_row["uploads"];
        $file_ext = substr($filename, strripos($filename, '.')); 
        $upfile = $dirfile.$file_basename . $file_ext;
        $update = "UPDATE account set uploads = uploads + 1 where username = '" . $username . "'";
        $date = date('c');
        mysql_query($update);
        if(is_uploaded_file($_FILES["file"]["tmp_name"]))
        {
            if(!move_uploaded_file($_FILES["file"]["tmp_name"],$upfile))
            {
                $result="6"; //Failed to move file from temporary directory
            }
            else /*Successfully upload file*/
            {
                //insert into media table
                $insert = "insert into media(mediaid, filename,username,type, path,upload_time)".
                "values(NULL,'". urlencode($postname)."','$username','".$_FILES["file"]["type"]."', '$upfile','$date')";
                $queryresult = mysql_query($insert)
                or die("Insert into Media error in media_upload_process.php " .mysql_error());
                $result="0";
                chmod($upfile, 0644);
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
