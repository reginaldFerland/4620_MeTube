<!DOCTYPE html>
<?php
	include_once "function.php";
?>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Browse</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <!--<link rel="stylesheet" type="text/css" href="css/default.css" /> -->
    <script type="text/javascript" src="js/jquery-latest.pack.js"></script>
    <script type="text/javascript">
    function saveDownload(id)
    {
        $.post("media_download_process.php",
        {
            id: id,
        },
        function(message) 
        { }
        );
    } 
    </script>
</head>

<body>

<!-- browse categories -->

<div id='upload_result'>
    <?php 
        if(isset($_REQUEST['result']) && $_REQUEST['result']!=0)
        {		
            echo upload_error($_REQUEST['result']);
        }
    ?>
</div>
<br/><br/>
<!-- Query media -->
<?php

    $query = "SELECT * from media"; 
    $result = mysql_query( $query );
    if (!$result){
       die ("Could not query the media table in the database: <br />". mysql_error());
    }
?>
    
<!-- Display media -->
<div class="row">
                 <!-- Loops through all results -->
                 <?php 
			while ($result_row = mysql_fetch_row($result)) //filename, username, type, mediaid, path
			{ 
				$mediaid = $result_row[3];
                                $username = $result_row[1];
                                $type = $result_row[2];
				$filename = $result_row[0];
				$filenpath = $result_row[4];
                                $time_access= $result_row[5];
                                $time_created = $result_row[6];
                                $viewcount = $result_row[7];
		?>

<div class="col"> 
<div class="card text-center" style="width: 18rem;">
  <a href="media.php?id=<?php echo $mediaid;?>" target="_blank"><img class="card-img-top" src="<?php echo $filenpath; ?>" alt="Card image cap"></a>
  <div class="card-body">
    <h5 class="card-title"><?php echo $filename; ?></h5>
    <p class="card-text">From: <?php echo $username; ?></p>
    <p class="card-text">Views: <?php echo $viewcount; ?> </p>
  </div>
</div>
</div>

           <!-- End loop -->
        	<?php
			}
		?>

</div>

</body>
</html>
