<?php
include "mysqlClass.inc.php";

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
   
?>
