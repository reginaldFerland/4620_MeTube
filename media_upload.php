<?php
session_save_path("/home/rferlan/public_html/metube/session");
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

<form method="post" action="media_upload_process.php" enctype="multipart/form-data" >
 
    <p style="margin:0; padding:0">
    <input type="hidden" name="MAX_FILE_SIZE" value="10485760" />
        Add a Media: <label style="color:#663399"><em> (Each file limit 10M)</em></label><br/>
    <input name="file" type="file" size="50" />
    <input name="name" type="text" placeholder="Name"/>
    <input name="description" type="text" placeholder="Description?"/>
    <input name="tags" type="text" placeholder="dog, cat, mountians, ect"/>
  
    <input value="Upload" name="submit" type="submit" />
    </p>
 
                
</form>

<?php
    include('footer.php');
?>

</body>
</html>
