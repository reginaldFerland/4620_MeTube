<?php
session_save_path("/home/rferlan/public_html/metube/session");
session_start();
include_once "functions/upload_functions.php";
include_once "functions/account_functions.php";

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
  
        // Get upload for filename
        $file_basename = get_uploads($username);

        $file_path = $dirfile . $file_basename . $file_ext;
        
        // Meta Data creation
        if(!empty($_POST["name"])) {
            $name = $_POST["name"];
        }
        else {
            $name = substr($original_filename,0,strripos($original_filename,'.'));
        }
        
        // Update account
        increment_upload($username);

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
                $description = $_POST["description"];
                $mediaID = add_media($file_path, $_FILES["file"]["type"], $name, $description);
                $ip = $_SERVER['REMOTE ADDR'];
                
                // Insert into Uploads
                create_upload($username, $mediaID, $ip);
    
                // Return all good
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
