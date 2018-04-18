<?
    include_once("functions/comments_functions.php");
    include_once("functions/account_functions.php");
    session_save_path("./session");
    session_start(); 

    $id = $_SESSION['viewing'];

    create_comment($_SESSION['username'],$id,$_POST['comment']);

    header("Location: ./media.php?id=$id");
?>
    
