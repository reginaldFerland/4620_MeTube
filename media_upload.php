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

<div class="col-4 col-offset-4" style="max-width: 500px; margin: 20px auto">
<form class="form-group" method="post" action="media_upload_process.php" enctype="multipart/form-data" >
 
    <input type="hidden" name="MAX_FILE_SIZE" value="10485760" />
        Add a Media: <label style="color:#663399"><em> (Each file limit 10M)</em></label><br/>
    <div class="md-form">
        <input name="file" type="file" size="50" />
    </div>
    <div class="md-form">
        <input name="name" type="text" placeholder="Name"/>
    </div>
    <div class="md-form">
        <textarea name="description" type="text" placeholder="Description"></textarea>
    </div>
    <div class="md-form">
        <input name="tags" type="text" placeholder="dog, cat, mountians, ect"/>
    </div>
    <div class="md-form">
        <input value="Upload" name="submit" type="submit" />
    </div>
 
</form>
</div>

<?php
    include('footer.php');
?>

</body>
</html>
