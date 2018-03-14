<?php
    session_save_path("/home/rferlan/public_html/metube/session");
    session_start();
    session_unset();
    session_destroy();
    header("Location: index.php");
?>
