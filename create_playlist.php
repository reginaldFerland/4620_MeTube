<!doctype html>
<html>
<head>
<title>Create Playlist</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>

<?php
    session_save_path("./session");
    session_start();
    include_once('functions/playlist_functions.php');
    include_once('functions/account_functions.php');

    $username = $_SESSION['username'];
    $mediaID = $_REQUEST['id'];
    $_SESSION['add_video'] = $mediaID;

    if(!user_exists($username))
        header("Location: index.php");


?>

<!-- Include same header across website -->
<?php
    include('header.php');
?>

<h1 class="text-center jumbotron mx-auto"> Create Playlist </h1>

<!-- FORM -->

<div class="col-sm-4 mx-auto" style="margin:20px">
<form class="form-group" method="post" action="playlist_create_process.php?" enctype="multipart/form-data" >
 
    <div class="md-form">
        <input class="form-control" name="name" type="text" placeholder="Name"/>
    </div>
    <div class="md-form">
        <textarea class="form-control" name="description" type="text" placeholder="Description"></textarea>
    </div>
    <div class="form-check-inline mx-auto">
        <!-- Comedy -->
        <input class="form-check-input" type="checkbox" name="comedy">
        <label class="form-check-label">Comedy </label>

        <!-- Education -->
        <input class="form-check-input" type="checkbox" name="education">
        <label class="form-check-label">Education</label>

        <!-- Gaming -->
        <input class="form-check-input" type="checkbox" name="gaming">
        <label class="form-check-label">Gaming</label>

        <!-- Nature -->
        <input class="form-check-input" type="checkbox" name="nature">
        <label class="form-check-label">Nature</label>

        <!-- Music -->
        <input class="form-check-input" type="checkbox" name="music">
        <label class="form-check-label">Music</label>
    </div>
    <div class="md-form">
        <input class="form-control" name="tags" type="text" placeholder="Tags: dog, cat, mountians, ect"/>
    </div>
    <div class="md-form">
        <input class="btn btn-primary mx-auto" value="Upload" name="submit" type="submit" />
    </div>
 
</form>
</div>


<!-- Include same footer across website -->
<?php
    include('footer.php');
?>
</body>
</html>
