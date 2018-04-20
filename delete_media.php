<?
session_save_path("./session");
session_start();

#CONFIRM LOGIN
if(!isset($_SESSION['username']))
{
    header("Location: index.php");
}
else
{

    include_once("functions/media_functions.php");
    $id = $_REQUEST['id'];
    $info = get_media_info($id);
    $path = $info['path'];
    unlink($path);

    remove_media($id);

    // Delete file?


    header("Location: index.php");
}
?>
