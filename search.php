<!DOCTYPE html>
<?php
    include_once "function.php";
?>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Search</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <!--<link rel="stylesheet" type="text/css" href="css/default.css" /> -->
    <script type="text/javascript" src="js/jquery-latest.pack.js"></script>
</head>

<body>

<?php include('header.php'); ?>

<br/><br/>
<!-- Query media -->
<?php
    $searchTerm = $_POST["search"];
    $query = "SELECT * from Media INNER JOIN Upload on Upload.mediaID = Media.mediaID where public = True AND"
    ." ((name LIKE '%$searchTerm%') OR (username LIKE '%$searchTerm%') OR (description LIKE '%$searchTerm%')) ORDER BY viewcount DESC"; 
    $result = mysql_query( $query );
    if (!$result){
        die ("Could not query the media table in the database: <br />". mysql_error());
    }
?>

<h1 class="text-center">Results for "<?php echo $searchTerm?>"</h1>

<?php include('display_media.php');?>

<?php include('footer.php'); ?>

</body>
</html>
