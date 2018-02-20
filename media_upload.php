<?php
session_start();
?>
<!DOCTYPE>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Media Upload</title>
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
   <input  name="file" type="file" size="50" />
  
	<input value="Upload" name="submit" type="submit" />
  </p>
 
                
 </form>

<?php
    include('footer.php');
?>

</body>
</html>
