<?php
session_save_path("./session");
session_start();
?>
<!DOCTYPE html>
<html>
<head>
<title>Media Upload</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">

<?php
    if(!isset($_SESSION['username'])) { header("Location: index.php");}

?>
</head>

<body>
<?php
    include('header.php');
?>

<div class="col-sm-4 mx-auto" style="margin:20px">
<form class="form-group" method="post" action="media_upload_process.php" enctype="multipart/form-data" >
 
    <input type="hidden" name="MAX_FILE_SIZE" value="10485760" />
        Upload Media: <label style="color:#663399"><em> (Each file limit 10M)</em></label><br/>
    <div class="md-form">
        <input class="form-control-file btn btn-primary" name="file" type="file" size="50" />
    </div>
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

<?php
    include('footer.php');
?>

</body>
</html>
